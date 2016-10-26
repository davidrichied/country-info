jQuery(document).ready(function($) {
	document.getElementById("search-country").addEventListener("click", function(e) {
		e.preventDefault;
		var country_text = document.getElementById("co-search-input").value;

	  const data_for_user = {};
	  data_for_user['action'] = 'return_search_results';
	  data_for_user['country_text'] = country_text;

    jQuery.ajax({
      type:'POST',
      url: d2l_co_info_ajax.ajaxurl,
      data: data_for_user,
      beforeSend:function(){
        // can do something before data is sent
      },        
      success: function(res) {
      	var code_holder = document.getElementById('country-code-placeholder');
      	code_holder.innerHTML = res;
      } // success
    }); // jQuery.ajax
	})
})