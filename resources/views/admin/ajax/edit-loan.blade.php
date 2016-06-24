          <form method="POST" action="{{route('edit_loan')}}">
         
          <label> Rate of Interest</label>
          <input type='text' name='rateofinterest' class='input-md' value="{{$loanData->rateofinterest}}" required>
           <label> Terms</label>
           <input type='text' name='terms' class='input-md' value="{{$loanData->terms}}" required>
          <input type='hidden' name='lid' value="{{$loanData->id}}">
          <button class='btn btn-success' type='submit' name='edt_loan'> Save </button>
          </form>
          <!-- edit loan form -->
        