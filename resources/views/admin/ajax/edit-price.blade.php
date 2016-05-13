          <form method="POST" action="{{route('edit_price')}}">
          <label> Price</label>
          <input type='text' name='price' class='input-md' value="{{$price->price}}" required>
          <input type='hidden' name='p_id' value="{{$price->id}}">
          <button class='btn btn-success' type='submit' name='edt_price'> Save</button>
          </form>
        