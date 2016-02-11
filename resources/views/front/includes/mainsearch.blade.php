<!-- ================================================== MAIN SEARCH ================================================== -->
<section id="mx1">
      <div class="main-search">
    <div class="container">
          <div class="row"> 
        
        <!-- quick search -->
        <form method="get" action="#">
              <fieldset>
            
            <!-- quick search fields -->
            <div class="quick-search-fields" data-appear-animation="slideInLeft">
                  <div class="ten columns clearfix"> 
                
                <!-- select input -->
                <div class="two columns">
                      <div class="select-input">
                    <select id="make_search">
                          <option value="" selected="selected">Any Make</option>
                          <?php foreach ($Makes as $value) {
                            ?>
                          
                          <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                          <?php } ?>
                        </select>
                  </div>
                    </div>
                <!-- .select input --> 
                
                <!-- select input -->
                <div class="two columns" id="pres">
                      <div class="select-input">
                    <select id="model_search">
                          <option value="" selected="selected">Any Model</option>
                          <option value="acura">155</option>
                          <option value="alfa_romeo">156S</option>
                          <option value="aston_martin">156 JTD</option>
                          <option value="audi">Brera</option>
                          <option value="bentley">159 JTD</option>
                        </select>
                  </div>
                    </div>
                <!-- .select input --> 
                
                <!-- select input -->
                <div class="two columns">
                      <div class="select-input">
                    <select>
                          <option value="" selected="selected">Any Price</option>
                          <option value="acura">$0 - $10.000</option>
                          <option value="alfa_romeo">$10.000 - $20.000</option>
                          <option value="aston_martin">$20.000 - $40.000</option>
                          <option value="audi">$40.000 - $50.000</option>
                          <option value="audi">$50.000 +</option>
                        </select>
                  </div>
                    </div>
                <!-- .select input --> 
                
                <!-- select input -->
                <div class="two columns">
                      <div class="select-input">
                    <select>
                          <option value="" selected="selected">Any Mileage</option>
                          <option value="acura">0mi - 5.000mi</option>
                          <option value="alfa_romeo">5.000mi - 10.000mi</option>
                          <option value="aston_martin">10.000min - 50.000mi</option>
                          <option value="audi">50.000mi - 100.000mi</option>
                          <option value="audi">100.000mi - 150.000mi</option>
                          <option value="audi">150.000mi +</option>
                        </select>
                  </div>
                    </div>
                <!-- .select input --> 
                
                <!-- select input -->
                <div class="two columns">
                      <div class="select-input">
                    <select>
                          <option value="" selected="selected">Any Condition</option>
                          <option value="acura">New</option>
                          <option value="acura">Used</option>
                          <option value="alfa_romeo">Perfect</option>
                          <option value="aston_martin">Good</option>
                          <option value="audi">Damaged</option>
                        </select>
                  </div>
                    </div>
                <!-- .select input --> 
                
                <!-- select input -->
                <div class="two columns">
                      <div class="select-input">
                    <select>
                          <option value="" selected="selected">Any Year</option>
                          <option value="alfa_romeo">2010</option>
                          <option value="aston_martin">2011</option>
                          <option value="audi">2012</option>
                          <option value="bentley">2013</option>
                          <option value="bentley">2014</option>
                        </select>
                  </div>
                    </div>
                <!-- .select input --> 
                
              </div>
                </div>
            <!-- .quick search fileds --> 
            
             
            
            <!-- search buttons -->
            
            <!-- search buttons -->
            
          </fieldset>
            </form>
        <!-- .Quick Search --> 
        
      </div>
        </div>
  </div>
    </section>
<!-- ================================================== END MAIN SEARCH ================================================== --> 
