<?php
require_once 'includes/auth.php';
require_login(true); // Require admin role
require 'config/database.php';

$page_title = 'Dora AI - Knowledge Admin';
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $keywords = trim($_POST['keywords']);
        $response = trim($_POST['response']);
        
        if (empty($keywords) || empty($response)) {
            $error = "Both keywords and response are required.";
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO dors_knowledge (keywords, response, created_by) VALUES (?, ?, ?)");
                $stmt->execute([$keywords, $response, $_SESSION['user_id']]);
                $message = "Knowledge successfully added to Dora's brain!";
            } catch (PDOException $e) {
                $error = "Error adding knowledge: " . $e->getMessage();
            }
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id = $_POST['id'];
        try {
            $stmt = $pdo->prepare("DELETE FROM dors_knowledge WHERE id = ?");
            $stmt->execute([$id]);
            $message = "Knowledge entry deleted.";
        } catch (PDOException $e) {
            $error = "Error deleting knowledge.";
        }
    }
}

// Fetch all knowledge entries
$stmt = $pdo->query("SELECT k.*, u.username FROM dors_knowledge k LEFT JOIN users u ON k.created_by = u.id ORDER BY k.id DESC");
$knowledge_entries = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="row mb-4">
    <div class="col-12">
        <h1 class="mb-3 animate-fade-in">
            <i class="fas fa-brain text-primary me-2"></i>
            Dora AI <strong>Knowledge Admin</strong>
        </h1>
        <p class="text-muted">Train Dora by adding custom keywords and responses directly into her live database.</p>
    </div>
</div>

<?php if ($message): ?>
    <div class="alert alert-success alert-dismissible fade show animate-fade-in" role="alert">
        <i class="fas fa-check-circle me-2"></i> <?php echo htmlspecialchars($message); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger alert-dismissible fade show animate-fade-in" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row mb-5">
    <div class="col-lg-5 mb-4">
        <div class="card shadow-sm border-0 animate-fade-in h-100">
            <div class="card-header bg-primary text-white border-0 py-3">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add New Knowledge</h5>
            </div>
            <div class="card-body">
                <form action="dors-admin.php" method="POST">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="keywords" class="form-label fw-bold">Trigger Keywords (comma separated)</label>
                        <input type="text" class="form-control" id="keywords" name="keywords" placeholder="e.g. what is pharma shop, pharma shop" required>
                        <small class="text-muted">When users ask these words, Dora will reply with the response.</small>
                    </div>
                    <div class="mb-4">
                        <label for="response" class="form-label fw-bold">Dora's Response (Supports Markdown)</label>
                        <textarea class="form-control" id="response" name="response" rows="6" placeholder="Enter the exact response here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                        <i class="fas fa-cloud-upload-alt me-2"></i> Inject into Dora's Brain
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-7 mb-4">
        <div class="card shadow-sm border-0 animate-fade-in h-100">
            <div class="card-header bg-dark text-white border-0 py-3">
                <h5 class="mb-0"><i class="fas fa-database me-2"></i>Live Knowledge Database</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-hover mb-0">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>ID</th>
                                <th>Keywords</th>
                                <th>Response Snippet</th>
                                <th>Added By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($knowledge_entries) > 0): ?>
                                <?php foreach ($knowledge_entries as $entry): ?>
                                    <tr>
                                        <td><?php echo $entry['id']; ?></td>
                                        <td><span class="badge bg-secondary"><?php echo htmlspecialchars($entry['keywords']); ?></span></td>
                                        <td><small><?php echo htmlspecialchars(substr($entry['response'], 0, 50)) . '...'; ?></small></td>
                                        <td><?php echo htmlspecialchars($entry['username'] ?? 'System'); ?></td>
                                        <td>
                                            <form action="dors-admin.php" method="POST" onsubmit="return confirm('Delete this entry?');">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $entry['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No custom knowledge added yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
