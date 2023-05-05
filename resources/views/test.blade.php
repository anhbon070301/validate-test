<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<form id="myform" action="" method="post">
    <input type="text" name="email" id="email">
    <input type="text" name="pass" id="pass">
    <input type="submit" value="Submit">
</form>
<script>
    $(document).ready(function() {
        $("#myform").validate({
            rules: {
                pass: {
                    required:true
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "/check-mail", // Đường dẫn đến route xử lý kiểm tra unique
                        type: "GET", // Phương thức HTTP để gửi yêu cầu kiểm tra unique
                        data: {
                            email: function() {
                                return $("#email").val(); // Lấy giá trị của input email
                            }
                        }
                    }
                }
            },
            messages: {
                email: {
                    required: "Email không được để trống",
                    email: "Email không đúng định dạng",
                    remote: "Email đã được sử dụng"
                },

                pass: {
                    required: "Pass không được để trống"
                }
            }
        });
    });
</script>