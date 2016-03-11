/* Begin Of jQuery or JS Custom Scripts - This line of codemust stay intact */
jQuery( document ).ready( function ( $ )
{
    /* Markers */
 
    //set up map options
    
    /* NAV */
   

    /** Stay Active Until Sub Nav Active **/
    

    /* RESPONSIVE NAV */

    // Create the dropdown base
    

    // Create default option "Go to..."
    
    // Populate dropdown with menu items
    


    /* main search toggle */
    


    /* revolution slider */
    
        // scroll body to 0px on click
        

    /* Tabs */
   

    /* Carell Animate Elements */
    

    /* Carell Knob */

    
    /* Lightboxes Modals */

    $( '.popup-modal' ).magnificPopup(
    {
        removalDelay: 500,
        type: 'inline',
        midClick: true,
        callbacks:
        {
            beforeOpen: function ( )
            {
                
                
                var bid=this.st.el.attr("data-bid");
                console.log(bid);

                $.ajax({
                      url: "../../ajax/bidhistory",
                      data: {bid:bid},
                      type :"post",
                      success: function( data ) {
                        if(data){
                          $('.bidhistory').html(data);
                        }
                        
                      
                      }
                });
                this.st.mainClass = this.st.el.attr( 'data-effect' );
            }
        },
    } );

    $( '.popup-image' ).magnificPopup(
    {
        removalDelay: 500,
        type: 'image',
        midClick: true,
        callbacks:
        {
            beforeOpen: function ( )
            {
                this.st.mainClass = this.st.el.attr( 'data-effect' );

            }
        },
    } );

    $( '.popup-gallery' ).each( function ( )
    {
        $( this ).magnificPopup(
        {
            removalDelay: 500,
            midClick: true,
            delegate: 'a',
            type: 'image',
            gallery:
            {
                enabled: true
            },
            callbacks:
            {
                beforeOpen: function ( )
                {
                    this.st.mainClass = this.st.el.attr( 'data-effect' );
                }
            },
        } );
    } );

    /* car boxes responsiveness */

    

    /* Count Down */
    
    /* On click hide */
    
    /* Z-index */
    

	/* contact form */
	
	
    /* End Of jQuery or JS Custom Scripts - This line of code must stay intact */
} );
