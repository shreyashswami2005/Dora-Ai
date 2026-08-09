const express = require('express');
const mongoose = require('mongoose');
const session = require('express-session');
const path = require('path');
const dotenv = require('dotenv');

dotenv.config();

const app = express();

// Middleware
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(session({
  secret: process.env.SESSION_SECRET || 'dora-secret-key-123',
  resave: false,
  saveUninitialized: true,
  cookie: { secure: process.env.NODE_ENV === 'production' }
}));

// Set EJS as templating engine
app.set('view engine', 'ejs');
// We need to resolve views folder properly for Vercel
app.set('views', path.join(__dirname, '../views'));

// Connect to MongoDB
const connectDB = async () => {
  if (mongoose.connections[0].readyState) return;
  try {
    await mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/dora_db', {
      useNewUrlParser: true,
      useUnifiedTopology: true
    });
    console.log('MongoDB Connected');
  } catch (err) {
    console.error('MongoDB connection error:', err);
  }
};

// Import Models
const User = require('../models/User');
const Knowledge = require('../models/Knowledge');

// API Routes
app.get('/api/knowledge', async (req, res) => {
  await connectDB();
  try {
    const knowledge = await Knowledge.find().sort({ created_at: -1 });
    const formattedKnowledge = knowledge.map(k => ({
      keywords: k.keywords.split(',').map(kw => kw.trim()),
      response: k.response
    }));
    res.json({ status: 'success', data: formattedKnowledge });
  } catch (err) {
    res.status(500).json({ status: 'error', message: 'Database error' });
  }
});

// Front-End Routes (Views)
app.get('/', (req, res) => {
  res.redirect('/dors-ai.html');
});

const requireLogin = (req, res, next) => {
  if (!req.session.user_id) return res.redirect('/login');
  next();
};

const requireAdmin = (req, res, next) => {
  if (!req.session.user_id || req.session.role !== 'admin') return res.redirect('/dashboard');
  next();
};

app.get('/login', (req, res) => {
  if (req.session.user_id) return res.redirect('/dashboard');
  res.render('login', { error: null });
});

app.post('/login', async (req, res) => {
  await connectDB();
  const { email, password } = req.body;
  
  if (!email || password.length < 6) {
    return res.render('login', { error: 'Invalid email or password.' });
  }

  const bcrypt = require('bcryptjs');
  
  try {
    const user = await User.findOne({ email });
    if (user && await bcrypt.compare(password, user.password_hash)) {
      req.session.user_id = user._id;
      req.session.username = user.username;
      req.session.role = user.role;
      return res.redirect('/dashboard');
    }
    res.render('login', { error: 'Invalid email or password.' });
  } catch (err) {
    res.render('login', { error: 'Server error. Try again.' });
  }
});

app.get('/dashboard', requireLogin, (req, res) => {
  res.render('dashboard', {
    user: req.session,
    total_sales: 12500,
    inventory_count: 450,
    low_stock: 12,
    orders_today: 25
  });
});

app.get('/dors-admin', requireAdmin, async (req, res) => {
  await connectDB();
  const knowledge_entries = await Knowledge.find().populate('created_by', 'username').sort({ created_at: -1 });
  res.render('dors-admin', { message: null, error: null, knowledge_entries });
});

app.post('/dors-admin', requireAdmin, async (req, res) => {
  await connectDB();
  const { action, keywords, response, id } = req.body;
  let message = null, error = null;

  try {
    if (action === 'add') {
      if (!keywords || !response) {
        error = "Both keywords and response are required.";
      } else {
        const newKnowledge = new Knowledge({ keywords, response, created_by: req.session.user_id });
        await newKnowledge.save();
        message = "Knowledge successfully added to Dora's brain!";
      }
    } else if (action === 'delete') {
      await Knowledge.findByIdAndDelete(id);
      message = "Knowledge entry deleted.";
    }
  } catch (err) {
    error = "Database error occurred.";
  }

  const knowledge_entries = await Knowledge.find().populate('created_by', 'username').sort({ created_at: -1 });
  res.render('dors-admin', { message, error, knowledge_entries });
});

app.get('/logout', (req, res) => {
  req.session.destroy();
  res.redirect('/login');
});

app.get('/register', (req, res) => {
  if (req.session.user_id) return res.redirect('/dashboard');
  res.render('register', { error: null, success: null });
});

app.post('/register', async (req, res) => {
  await connectDB();
  const { username, email, password } = req.body;
  let error = null, success = null;
  
  if (username.length < 3) error = 'Username must be at least 3 characters.';
  else if (!email.includes('@')) error = 'Invalid email.';
  else if (password.length < 6) error = 'Password must be at least 6 characters.';
  else {
    const existing = await User.findOne({ $or: [{ username }, { email }] });
    if (existing) {
      error = 'Username or email already exists.';
    } else {
      const bcrypt = require('bcryptjs');
      const password_hash = await bcrypt.hash(password, 10);
      const newUser = new User({ username, email, password_hash });
      await newUser.save();
      success = 'Registration successful! You can now <a href="/login">login</a>.';
    }
  }
  res.render('register', { error, success });
});

// We need to serve static files from root directory (HTML/CSS/JS)
app.use(express.static(path.join(__dirname, '../')));

module.exports = app;
