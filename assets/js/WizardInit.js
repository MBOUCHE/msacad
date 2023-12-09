/*====================================
 Free To Use For Personal And Commercial Usage
Author: http://binarytheme.com
 License: Open source - MIT
 Please visit http://opensource.org/licenses/MIT for more Full Deatils of license.
 Share Us if You Like our work 
 Enjoy Our Codes For Free always.
======================================*/
//horizontal wizrd code section
/*$(function () {
    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        stepsOrientation: "vertical",
        onStepChanging: function(e, currentIndex, newIndex) {
            var fv         = $('#wizardV').data('formValidation'), // FormValidation instance
                // The current step container
                $container = $('#wizardV').find('section[data-step="' + currentIndex +'"]');

            // Validate the container
            fv.validateContainer($container);

            var isValidStep = fv.isValidContainer($container);
            if (isValidStep === false || isValidStep === null) {
                // Do not jump to the next step
                return false;
            }

            return true;
        },

        onFinishing: function(e, currentIndex) {
            var fv         = $('#profileForm').data('formValidation'),
                $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

            // Validate the last step container
            fv.validateContainer($container);

            var isValidStep = fv.isValidContainer($container);
            if (isValidStep === false || isValidStep === null) {
                return false;
            }

            return true;
        },

        onFinished: function(e, currentIndex) {
            // Uncomment the following line to submit the form using the defaultSubmit() method
            // $('#profileForm').formValidation('defaultSubmit');

            // For testing purpose
            $('#welcomeModal').modal();
        }
    }).formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            question: {
                validators: {
                    notEmpty: {
                        message: 'Vous devez entrer une question secrète'
                    },
                    stringLength: {
                        min: 8,
                        max: 128,
                        message: 'Votre question doit être compris entre 8 et 128 caractères'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.\+\$]+?$/,
                        message: 'Ceci n\'est pas une question'
                    }
                }
            },
            answer: {
                validators: {
                    notEmpty: {
                        message: 'Vous devez entrer la réponse à votre question secrète'
                    },
                    stringLength: {
                        min: 8,
                        max: 128,
                        message: 'Votre réponse doit être comprise entre 8 et 128 caractères'
                    }
                }
            },
            npwd: {
                validators: {
                    notEmpty: {
                        message: 'Vous devez changer votre mot de passe'
                    },
                    stringLength: {
                        min: 8,
                        max: 128,
                        message: 'Votre réponse doit être comprise entre 8 et 128 caractères'
                    }
                }
            },
            mcq: {
                validators: {
                    notEmpty: {
                        message: 'Vous devez choisir au moins un éléments dans la liste'
                    }
                }
            }
        }
    });
});*/
//vertical wizrd  code section
/*$(function () {
    $("#wizardV").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        stepsOrientation: "vertical",
        onStepChanging: function(e, currentIndex, newIndex) {
            var fv=$('#wizardV').data('formValidation'), // FormValidation instance
                // The current step container
                $container = $('#wizardV').find('section[data-step="' + currentIndex +'"]');

            // Validate the container
            fv.validateContainer($container);

            var isValidStep = fv.isValidContainer($container);
            if (isValidStep === false || isValidStep === null) {
                // Do not jump to the next step
                return false;
            }

            return true;
        },

        onFinishing: function(e, currentIndex) {
            var fv         = $('#wizardV').data('formValidation'),
                $container = $('#wizardV').find('section[data-step="' + currentIndex +'"]');

            // Validate the last step container
            fv.validateContainer($container);

            var isValidStep = fv.isValidContainer($container);
            if (isValidStep === false || isValidStep === null) {
                return false;
            }

            return true;
        },

        onFinished: function(e, currentIndex) {
            // Uncomment the following line to submit the form using the defaultSubmit() method
            // $('#profileForm').formValidation('defaultSubmit');

            // For testing purpose
            $('#welcomeModal').modal();
        }
    }).formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            question: {
                validators: {
                    notEmpty: {
                        message: 'Vous devez entrer une question secrète'
                    },
                    stringLength: {
                        min: 8,
                        max: 128,
                        message: 'Votre question doit être compris entre 8 et 128 caractères'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.\+\$]+?$/,
                        message: 'Ceci n\'est pas une question'
                    }
                }
            },
            answer: {
                validators: {
                    notEmpty: {
                        message: 'Vous devez entrer la réponse à votre question secrète'
                    },
                    stringLength: {
                        min: 8,
                        max: 128,
                        message: 'Votre réponse doit être comprise entre 8 et 128 caractères'
                    }
                }
            },
            npwd: {
                validators: {
                    notEmpty: {
                        message: 'Vous devez changer votre mot de passe'
                    },
                    stringLength: {
                        min: 8,
                        max: 128,
                        message: 'Votre réponse doit être comprise entre 8 et 128 caractères'
                    }
                }
            },
            mcq: {
                validators: {
                    notEmpty: {
                        message: 'Vous devez choisir au moins un éléments dans la liste'
                    }
                }
            }
        }
    });
});*/

$(function () {
    var form=$("#wizardV");
    form.steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        stepsOrientation: "vertical",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }

            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex)
            {
                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {

        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            form.submit();
        }
    }).validate({
        errorPlacement: function(error, element) {
            // Append error within linked label
            error.addClass('w3-text-red');
            $( element )
                .closest( "form" )
                .find( "label[for='" + element.attr( "id" ) + "']" )
                .append( error );
        },
        errorElement: "span",
        rules: {
            npwd: "required",
            cpwd: {
                required: true,
                equalTo: "#npwd"
            },
            question : {
                required: true,
                minlength: 8,
                maxlength: 128
            },
            answer: {
                required: true,
                minlength: 1,
                maxlength: 128
            }
        },
        messages: {
            npwd: "  (Veuillez changer votre mot de passe)",
            cpwd: {
                required: "  (Veuillez confirmer votre mot de passe)",
                equalTo: "  (Le mot de passe et la confirmation ne correspondent pas)"
            },
            question:{
                required: "  (Veuillez entrer votre question secrète)",
                minlength: "  (Votre question doit être comprise entre 8 et 128 caractères)",
                maxlength: "  (Votre question doit être comprise entre 8 et 128 caractères)"
            },
            answer :{
                required: "  (Veuillez entrer la réponse à votre question secrète)",
                minlenght: "  (Votre réponse doit être comprise entre 1 et 128 caractères)",
                maxlength: "  (Votre réponse doit être comprise entre 1 et 128 caractères)"
            }
        }
    });
});