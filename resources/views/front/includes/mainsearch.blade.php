<!-- ================================================== MAIN SEARCH ================================================== -->
<section id="mx1">
    <div class="main-search">
          <div class="container">
              <div class="row"> 

                  <!-- quick search -->
                  <form method="get" action="#" id="test">
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
                                  <div class="two columns" id="nextis"> 

                                  <!-- search -->
                                    <div class="search-left" data-appear-animation="slideInRight">
                                        <button type="submit"> <span class="icon-forward"></span>Next</button>
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
