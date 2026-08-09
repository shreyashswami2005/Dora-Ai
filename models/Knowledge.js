const mongoose = require('mongoose');

const knowledgeSchema = new mongoose.Schema({
  keywords: { type: String, required: true },
  response: { type: String, required: true },
  created_by: { type: mongoose.Schema.Types.ObjectId, ref: 'User' },
  created_at: { type: Date, default: Date.now }
});

module.exports = mongoose.models.Knowledge || mongoose.model('Knowledge', knowledgeSchema);
