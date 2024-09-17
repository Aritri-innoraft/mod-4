// (function ($) {
//   Drupal.behaviors.phoneNumberFormat = {
//     attach: function (context, settings) {
//       // $('#edit-field-phone-number-0-value').once('phone-number-format').each(function () {
//         $(this).on('input', function () {
//           alert("name");
//           // Remove non-digit characters
//           var phoneNumber = $(this).val().replace(/\D/g, ''); 
          
//           if (phoneNumber.length === 10) {
//             var formattedPhoneNumber = '(' + phoneNumber.substr(0, 3) + ') ' + phoneNumber.substr(3, 3) + '-' + phoneNumber.substr(6, 4);
//             $(this).val(formattedPhoneNumber);
//           }
//         });
//       // });
//     }
//   };
// })(jQuery);



(function ($) {
  Drupal.behaviors.phoneNumberFormat = {
      attach: function (context, settings) {
          var phoneNumberFields = $('input[name="field_phone_number[0][value]"]', context);
          // console.log('Number of fields found:', phoneNumberFields.length);
          phoneNumberFields.on('input', function () {
              var inputValue = $(this).val().replace(/\D/g, '');

              // var formattedValue = '';
              // for (var i = 0; i < inputValue.length; i++) {
              //     // console.log('Inputted number:', inputValue[i]);
              //     // console.log('Inputted number:', i);
              //     if (i === 0) formattedValue += '(';
              //     if (i === 3) formattedValue += ') ';
              //     if (i === 6) formattedValue += '-';
              //     formattedValue += inputValue[i];
              // }

              // $(this).val(formattedValue);

              if (inputValue.length === 10) {
                var formattedPhoneNumber = '(' + inputValue.substr(0, 3) + ') ' + inputValue.substr(3, 3) + '-' + inputValue.substr(6, 4);
                $(this).val(formattedPhoneNumber);
                console.log($(this).val(formattedPhoneNumber));
              }
          });
      }
  };
})(jQuery);
