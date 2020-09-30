<div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header bg-info">
           <h5 class="modal-title" id="exampleModalLabel">Holiday </h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
           <div class="modal-body p-3">
            <span id="form_result"></span>
            <form  id="sample_form" class="form-horizontal" method="post" enctype="multipart/form-data">
             @csrf

             <input type="hidden" name="updateId" id="updateId">

             <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <select name="cat_id" id="cat_id" class="form-control"  >
                           <option value="">Select Category Name</option>
                           @foreach ($categoryData as $item)
                               <option value="{{ $item->id }}">{{ $item->name }}</option>
                           @endforeach
                       </select>
                   </div>
               </div>
             </div>

             <div class="row">
               <div class="col-md-12">
                 <div class="form-group">
                   <label>Subcategory</label>
                   <input type="text" name="name" id="name" class="form-control"
                   placeholder="Enter Subcategory Name">

                 </div>
               </div>
             </div>


           <div class="modal-fotter">
            <div class="row">
              <div class="col-md-9">
                 <div class="form-group mx-auto">
                 <input type="hidden" name="action" id="action" />
                 <input type="hidden" name="hidden_id" id="hidden_id" />
                 <input type="submit" name="action_button" id="action_button" class="btn btn-primary btn-block" value="Add" />
                </div>
              </div>
              <div class="col-md-3">
                <input type="button" name="cancel" data-dismiss="modal" value="cancel" class="btn btn-warning  btn-block">
              </div>
            </div>
           </div>

           </form>
        </div>
       </div>
   </div>
