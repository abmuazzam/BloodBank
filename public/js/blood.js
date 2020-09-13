$(document).ready(function(){
   $('#datatable-for-blood').DataTable();
});
function deleteBlood(id){
   swal({
      title: "",
      text: "Are You sure?",
      type: "success",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonClass: "btn btn-outline-success",
      cancelButtonClass: "btn btn-outline-danger",
      confirmButtonText: "Yes",
      cancelButtonText: "No"
   },function(isConfirm){
      if(isConfirm){
         document.location.href = "Blood/Delete/"+id;
      }
   });
}