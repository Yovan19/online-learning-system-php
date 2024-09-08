<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add New Course</h4>
            <p class="card-description"> Fill in the details to add a new course. </p>

            <!-- Success message alert -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissable fade-in mt-3">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                </div>
            <?php endif; ?>

            <!-- Failure message alert -->
            <?php if (isset($_SESSION['login_failure'])): ?>
                <div class="alert alert-danger alert-dismissable fade-in mt-3">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_SESSION['login_failure']; unset($_SESSION['login_failure']); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="">
                <!-- Form fields as before -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Course Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail Image URL</label>
                            <input type="text" class="form-control" id="thumbnail" name="thumbnail">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="label">Label</label>
                            <select class="form-control" id="label" name="label" required>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_of_star">Number of Stars (Rating)</label>
                            <input type="text" class="form-control" id="no_of_star" name="no_of_star">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount_with_amount">Discount (Text and Number)</label>
                            <input type="text" class="form-control" id="discount_with_amount" name="discount_with_amount">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_of_weeks">Number of Weeks</label>
                            <input type="number" class="form-control" id="no_of_weeks" name="no_of_weeks">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_of_lessons">Number of Lessons</label>
                            <input type="number" class="form-control" id="no_of_lessons" name="no_of_lessons">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_of_students">Number of Students</label>
                            <input type="number" class="form-control" id="no_of_students" name="no_of_students">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="published">Published</option>
                        <option value="unpublished">Unpublished</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Course</button>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/includes/footer.php'; ?>
