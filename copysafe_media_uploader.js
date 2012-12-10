jQuery(document).ready(function() {
    var file_name = null;

    jQuery( "#tabs" ).tabs();

    jQuery("#wpcsw_searchfile").suggest("./search.php",{
        onSelect: function() { file_name = this.value }
    });

    jQuery("#search").click(function(){
        file_name = jQuery("#wpcsw_searchfile").val();
        var postid = jQuery("#postid").val();
        if ( file_name == null) {
            alert ('Type a file name');
            jQuery("#wpcsw_searchfile").focus();
        }
        else {
            jQuery.get("search.php", { search: file_name, post_id: postid },
                function(data){
                    jQuery('#file_details').html(data);
            });
        }

    });

    jQuery("#cancel").live("click", function(){ jQuery('#file_details').html(""); });


    jQuery('.sendtoeditor').live("click", function() {
        var file = '[copysafe name="'+jQuery(this).attr('title')+'"][/copysafe]'
        window.parent.send_to_editor(file);
    });

    jQuery('.setdetails').live("click", function() {
        jQuery( "#tabs" ).tabs( "select", "tabs-2" );
        jQuery("#wpcsw_searchfile").val(jQuery(this).attr('title'));
        jQuery("#search").trigger("click");
    });
});