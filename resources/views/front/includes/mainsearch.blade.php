<!-- ================================================== MAIN SEARCH ================================================== -->
<section id="mx1">
    <div class="main-search">
          <div class="container">
              <div class="row"> 

                  <!-- quick search -->
                  <form method="get" action="#" id="test">
                        <fieldset>

                        <!-- quick search fields -->
                        <div class="quick-search-fields" data-appear-animation="slideInLeft" id="firsc">
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

                                        </select>
                                      </div>
                                  </div>
                                  <!-- .select input --> 

                                  <!-- select input -->
                                  <div class="two columns">
                                      <div class="select-input">
                                          <select id="condition_search">
                                              <option value="" selected="selected">Any Condition</option>
                                              <option value="acura">New</option>
                                              <option value="acura">Used</option>
                                          </select>
                                      </div>
                                  </div>
                                  <!-- .select input --> 

                                  <!-- select input -->
                                  <div class="two columns">
                                      <div class="select-input">
                                          <select id="year_search">
                                              <option value="" selected="selected">Any Year</option>
                                              
                                          </select>
                                      </div>
                                  </div>
                                  <!-- .select input --> 
                                  <div class="two columns" id="nextis" style="display:none;"> 

                                  <!-- search -->
                                    <div class="search-left" data-appear-animation="slideInRight">
                                        <button type="submit" id="plsnex"> <span class="icon-forward"></span>Next</button>
                                    </div>
                                  </div>
                              </div>
                        </div>

                        <div class="quick-search-fields" data-appear-animation="slideInLeft" id="secsc" style="display:none;">
                              <div class="ten columns clearfix"> 

                                  

                                  

                                  

                                  <!-- select input -->
                                  <div class="two columns">
                                      <div class="s-textinput">
                                          <input type="text" id="tamo" name="tamo" class="formcon" placeholder="Total Amount">
                                      </div>
                                  </div>
                                  <!-- .select input -->

                                  <!-- select input -->
                                  <div class="two columns">
                                      <div class="s-textinput">
                                          <input type="text" id="mtamo" name="mtamo" class="formcon" placeholder="Monthly Amount">
                                      </div>
                                  </div>
                                  <!-- .select input -->  

                                  <div class="two columns" id="nextistwo"> 

                                  <!-- search -->
                                    <div class="search-left" data-appear-animation="slideInRight">
                                        <button type="submit" id="npllses"> <span class="icon-forward"></span>Next</button>
                                    </div>
                                  </div>
                              </div>
                        </div>

                        <div class="quick-search-fields" data-appear-animation="slideInLeft" id="thirsc" style="display:none;">
                              <div class="ten columns clearfix"> 
                                  <!-- select input -->
                                  <div class="two columns">
                                      <div class="s-textinput">
                                          <input type="text" id="fname" name="fname" class="formcon" placeholder="First Name">
                                      </div>
                                  </div>
                                  <!-- .select input -->
                                  <!-- select input -->
                                  <div class="two columns">
                                      <div class="s-textinput">
                                          <input type="text" id="lname" name="lname" class="formcon" placeholder="Last Name">
                                      </div>
                                  </div>
                                  <!-- .select input -->
                                  <!-- select input -->
                                  <div class="two columns">
                                      <div class="s-textinput">
                                          <input type="text" id="phone" name="phone" class="formcon" placeholder="Phone">
                                      </div>
                                  </div>
                                  <!-- .select input -->

                                  <!-- select input -->
                                  <div class="two columns">
                                      <div class="s-textinput">
                                          <input type="text" id="email" name="email" class="formcon" placeholder="Email">
                                      </div>
                                  </div>
                                  <!-- .select input -->  

                                  <div class="two columns" id="donetes"> 

                                  <!-- search -->
                                    <div class="search-left" data-appear-animation="slideInRight">
                                        <button type="submit" id="dstes"> <span class="icon-forward"></span>Done</button>
                                    </div>
                                  </div>
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
