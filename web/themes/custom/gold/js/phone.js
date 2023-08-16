// (function ($) {
//     Drupal.behaviors.phoneNumberFormat = {
//       attach: function (context, settings) {
//         $('#edit-field-phone-number-0-value').once('phone-number-format').each(function () {
//           $(this).on('input', function () {
//             var phoneNumber = $(this).val().replace(/\D/g, ''); // Remove non-digit characters
            
//             if (phoneNumber.length === 10) {
//               var formattedPhoneNumber = '(' + phoneNumber.substr(0, 3) + ') ' + phoneNumber.substr(3, 3) + '-' + phoneNumber.substr(6, 4);
//               $(this).val(formattedPhoneNumber);
//             }
//           });
//         });
//       }
//     };
//   })(jQuery);
  