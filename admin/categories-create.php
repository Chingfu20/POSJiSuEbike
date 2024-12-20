<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
          <div class="card-header">
               <h4 class="mb-0">Add Category
                    <a href="categories" class="btn btn-danger float-end">Back</a>
               </h4>
          </div>
          <div class="card-body">
            
               <?php alertMessage(); ?>

               <form action="code.php" method="POST">
                    
                   <div class="row">
                    <div class="col-md-12 mb-3">
                         <label for="">Name *</label>
                         <input type="text" name="name" required class="form-control" />
                    </div>
                    <div class="col-md-12 mb-3">
                         <label for="">Description</label>
                         <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <br/>
                         <button type="submit" name="saveCategory" class="btn btn-primary">Save</button>
                    </div>
                   </div>

               </form>
          </div>
        </div>
     </div>

<?php include('includes/footer.php'); ?>
