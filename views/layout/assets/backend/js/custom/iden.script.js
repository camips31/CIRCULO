"use strict";

// Class Definition
var PlatformURLSystemAccess = function() {
    
    //localStorage.setItem(globalURLCirculo, 'https://circulodelaunion.ideas-envision.com/');
    localStorage.setItem(globalURLCirculo, 'http://localhost/IDEAS-ENVISION/circulodelaunion.ideas-envision.com/');    
    var globalURLCirculo = localStorage.getItem(globalURLCirculo);    


    // Public Functions
    return {
        // public functions
        init: function() {
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    PlatformURLSystemAccess.init();
});
