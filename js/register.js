$(document).ready(function(){
            $("#butsave").click(function(event){
            	event.preventDefault();
                var name=$("#name").val();
                var email=$("#email").val();
                var password=$("#password").val();
                var passwordconfirm=$("#passwordconfirm").val();

                if(name == "" || email == "" || password == "" || passwordconfirm == ""){
				                	Swal.fire(
				  'Hata',
				  'Boş alan bırakmayınız.',
				  'error'
				)
				                	return;
                } else if(password != passwordconfirm){
                	Swal.fire(
				  'Hata',
				  'Parolalar uyuşmuyor.',
				  'error'
				)
                			return;
                }
                else if(document.getElementById("remember").checked == false){
                	Swal.fire(
				  'Hata',
				  'Üyelik şartlarını kabul etmediniz.',
				  'error'
				)
                			return;
                }
                $.ajax({
                    url:'register.php',
                    method:'POST',
                    data:{
                        name:name,
                        email:email,
                        password:password,
                        passwordconfirm:passwordconfirm
                    },
			    success: function(dataResult){
			   		Swal.fire(
  'Üyelik Oluşturuldu',
  'Aramıza Hoşgeldiniz!',
  'success',
  ).then(function(){ 
   window.location.href = "giris";
   });
				fupForm.reset();
				
				var dataResult = JSON.parse(dataResult);
			  if(dataResult.statusCode==2){
				Swal.fire(
				  'Hata',
				  'Bu e-posta başka bir kullanıcıya ait.',
				  'error'
				)
				return;
			}
			else {
				Swal.fire(
				  'Hata',
				  'Beklenmedik bir hata meydana geldi, lütfen iletişime geçiniz.',
				  'error'
				)
				return;
			}
			  }
                });
            });
        });