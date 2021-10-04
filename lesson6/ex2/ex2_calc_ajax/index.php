<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

   <input type="text" id="val1" value="">
   <button class='add'> + </button>
    <button class='sub'> - </button>
    <button class='mul'> * </button>
    <button class='div'> / </button>
   <input class="text" id="val2" value="">
    =
   <input type="text" id="val3" value=""><br>

<script>
    function sendToCount(operator){
        $("." + operator).on('click', function(){
            var operand1 = $("#val1").val()
            var operand2 = $("#val2").val()

            $.ajax({
                url: "res.php",
                type: "POST",
                dataType : "json",
                data:{
                    operand1: operand1,
                    operand2: operand2,
                    operator: operator
                },
                error: function() {alert("Что-то пошло не так...");},
                success: function(answer){
                    $('#val3').val(answer.result);
                }

            })
        });

    }


    $(document).ready(sendToCount("add"));
    $(document).ready(sendToCount("sub"));
    $(document).ready(sendToCount("mul"));
    $(document).ready(sendToCount("div"));

</script>

	