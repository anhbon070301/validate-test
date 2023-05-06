<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<form id="myform" action="" method="post">
    <input type="text" name="email" id="email">
    <input type="text" name="pass" id="pass">
    <div class="form-group">
        <div class="file-loading">
            <label>Hình đại diện</label>
            <input id="sp_hinh" type="file" name="sp_hinh">
            <div class="preview-upload">
                <img id='sp_hinh-upload' />
            </div>
        </div>
    </div>
    <input type="submit" value="Submit">
</form>
<script>
    $(document).ready(function() {
        // Sử dụng FileReader để đọc dữ liệu tạm trước khi upload lên Server
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#sp_hinh-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Bắt sự kiện, ngay khi thay đổi file thì đọc lại nội dung và hiển thị lại hình ảnh mới trên khung preview-upload
        $("#sp_hinh").change(function() {
            readURL(this);
        });
        $("#myform").validate({
            rules: {
                pass: {
                    required: true
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