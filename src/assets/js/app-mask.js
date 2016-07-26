var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},

spOptions = {
  onKeyPress: function(val, e, field, options) {
	  field.mask(SPMaskBehavior.apply({}, arguments), options);
	},
  clearIfNotMatch: true
};

function activateMasks(){

	$( ".mask" ).each(function( index ) {
	  
	  if( $(this).hasClass('zipcode-mask') ){
	  
		$(this).mask('00000-000', {clearIfNotMatch: true});
	  
	  }
	  
	  if( $(this).hasClass('cnpj-mask') ){
	  
		$(this).mask('00.000.000/0000-00', {clearIfNotMatch: true});
	  
	  }
	  
	  if( $(this).hasClass('cpf-mask') ){
	  
		$(this).mask('000.000.000-00', {clearIfNotMatch: true});
	  
	  }  

	  if( $(this).hasClass('phone-mask') ){

		$(this).mask(SPMaskBehavior, spOptions);  
	  
	  }  
	  
	});
	
}

activateMasks();