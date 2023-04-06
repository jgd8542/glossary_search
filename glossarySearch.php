<script>
    ////GLOSSARY FUNCTION////////////////////
    function showResult(str) {

        if (str.length == 0) {

            document.getElementById("livesearch").innerHTML = "";

            document.getElementById("livesearch").style.display = "none";
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("livesearch").innerHTML = this.responseText;

                document.getElementById("livesearch").style.display = "block";
            }
        }
        xmlhttp.open("GET", <?php echo PROOT ?> + "app/views/WSWD/livesearch.php?q=" + str, true);

        xmlhttp.send();

    }

    function showDefinition(list_topic) {

        str = list_topic.text;

        if (str.length == 0) {

            document.getElementById("defsearch").innerHTML = "";

            document.getElementById("defsearch").style.display = "none";
            return;
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("livesearch").innerHTML = this.responseText;

                document.getElementById("livesearch").style.display = "block";
            }
        }

        xmlhttp.open("GET", <?php echo PROOT ?> + "app/views/WSWD/defsearch.php?q=" + str, true);

        xmlhttp.send();

    }

    window.addEventListener('click', function(e) {

        if (!document.getElementById('livesearch').contains(e.target)) {
            document.getElementById("livesearch").style.display = "none";
        }

    });

    function addDefinition() {

        // var request = '<label  style="font-weight:bold">Request:</label>'

        Swal.fire({
            title: "Add Definition to Glossary",
            html: '<br><label id="name" style="font-weight:bold">Your Name:</label><input id="swal-input1" class="swal2-input"><br><br>' +
                '<label id="email" style="font-weight:bold">Your Email:</label> <input id="swal-input2" class="swal2-input"> <br> <br> <br> <label  style="font-weight:bold;">Request:</label>',
            input: 'textarea',
            // inputLabel: request,
            inputPlaceholder: 'What would you like added to the glossary?',
            inputAttributes: {
                'aria-label': 'What would improve the glossary functionality for you and others?',
            },

            showCancelButton: true,
            confirmButtonColor: 'blue',
            inputValidator: (value) => {
                if (!value) {
                    return 'Please write something or cancel.'
                }
            },

            preConfirm: function() {
                val1 = $('#swal-input1').val();
                email = $('#swal-input2').val();




                return new Promise(function(resolve) {
                    if (validateEmail(email) && val1) {

                        resolve();

                    } else {
                        if (!validateEmail(email)) {
                            $('#email').css('color', 'red');
                            $('#swal-input2').css('border-color', 'red');
                        }
                        if (!val1) {
                            $('#name').css('color', 'red');
                            $('#swal-input1').css('border-color', 'red');
                        }
                        resolve(false);
                    }

                })

            },

        }).then((result) => {

            if (result.value) {

                axio.post('init.php', {
                    options: {
                        FullPath: 'Projects/main',
                        RMethod: 'addToGlossary',
                    },
                    params: {
                        name: val1,
                        email: email,
                        request: result.value,
                    },

                }).then((response) => {

                    swal({
                        title: 'Success!',
                        text: 'Your request has been sent to the WSWD team.',
                        type: 'success',
                        confirmButtonText: 'OK'
                    })
                });

            }
        })

    }
</script>
