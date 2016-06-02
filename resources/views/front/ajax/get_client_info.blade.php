<table class="table table-hover">
             <thead>
               <tr class="info">
                 <th>Name </th>
                 <th>Phone </th>
                 <th>Email </th>
               </tr>
             </thead>
             <tbody>
             
  
             </tbody>
               <tr>
                 <th> {{$LeadContact->client_details->first_name}} {{$LeadContact->client_details->last_name}} </th>
                 <th> {{$LeadContact->client_details->phone}} </th>
                 <th> {{$LeadContact->client_details->email}} </th>
               </tr>
            

 </tbody>
</table>