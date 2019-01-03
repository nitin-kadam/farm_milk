<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<style>
td{
    padding-left:60px;
}
</style>
<table><tr><td>
<form name="quote" id="price-quote" action="/#" method="post">
  <label class="control-label" for="bedrooms">Bedrooms</label><br>
  <select class="form-control-1" id="bedrooms" name="bedrooms_selection">
  
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
            </select>

  <br><label class="control-label" for="family_rooms">Family Rooms</label><br>
  <select class="form-control-1" id="family_rooms" name="family_room_selection">
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
  <br><label class="control-label" for="living_rooms">Living Rooms</label><br>
  <select class="form-control-1" id="living_rooms" name="living_room_selection">

              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
  <div class="total-price">
    <h2>Total Price: <span id="output1" name="total_price"></span></h2>
  </div>
</form>
</td>
<td>
<form name="quote" id="price-quote" action="/#" method="post">
  <label class="control-label" for="bedrooms">Bedrooms</label><br>
  <select class="form-control-1" id="bedrooms" name="bedrooms_selection">
  
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
            </select>

  <br><label class="control-label" for="family_rooms">Family Rooms</label><br>
  <select class="form-control-1" id="family_rooms" name="family_room_selection">
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
  <br><label class="control-label" for="living_rooms">Living Rooms</label><br>
  <select class="form-control-1" id="living_rooms" name="living_room_selection">

              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
  <div class="total-price">
    <h2>Total Price: <span id="output2" name="total_price"></span></h2>
  </div>
</form>
</td>
<td>
</td>
</tr>
</table>
<script>
//define prices as simple JS object, where keys will match the id attributes of the select tags 
prices = {
  'bedrooms': 4,
  'family_rooms': 6,
  'living_rooms': 7
};

$(function() { //wait for DOM to be Ready
  //find all <select> tags in the document
  var selects = $('select');
  //when any select list changes, run the callback function
  selects.change(function(changeEvent) {
    var changedSelectList = changeEvent.target;
    //only update the total if there is a price
    if (Object.keys(prices).includes(changedSelectList.id) && prices[changedSelectList.id]) {
      //iterate over select lists and sum the prices
      var totalPrice = [...selects].reduce(function(sum, select) {
        //if there is a selected value for the select list
        if ($(select).val()) {
          //add the product of the selected value and the price
          sum += $(select).val() * prices[select.id];
        }
        //return the sum for the next iteration of the loop
        return sum;
      }, 0); //start the total at 0
      //update the output
      $("#output1").text(totalPrice)
    }

  });
})



$(function() { //wait for DOM to be Ready
  //find all <select> tags in the document
  var selects = $('select');
  //when any select list changes, run the callback function
  selects.change(function(changeEvent) {
    var changedSelectList = changeEvent.target;
    //only update the total if there is a price
    if (Object.keys(prices).includes(changedSelectList.id) && prices[changedSelectList.id]) {
      //iterate over select lists and sum the prices
      var totalPrice = [...selects].reduce(function(sum, select) {
        //if there is a selected value for the select list
        if ($(select).val()) {
          //add the product of the selected value and the price
          sum += $(select).val() * prices[select.id];
        }
        //return the sum for the next iteration of the loop
        return sum;
      }, 0); //start the total at 0
      //update the output
      $("#output2").text(totalPrice)
    }

  });
})



</script>