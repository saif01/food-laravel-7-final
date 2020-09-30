 $(document).ready(function() {

 $('.file-export').DataTable({
 dom: 'Bfrtip',
 "order": [],
 "stateSave": true,
 buttons: [
 'copy', 'csv', 'excel', 'pdf', 'print'
 ]
 });
 $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-outline-primary mr-1');

 });