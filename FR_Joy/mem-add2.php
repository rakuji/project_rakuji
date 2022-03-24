<?php
$title = 'About';
$systemName = '會員管理系統';
$systemitem = '會員新增';

?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/banner.php'; ?>

<div class="container-fluid">
	<div class="row">

		<!-- 左側選單欄 -->
		<div class="col-12 col-md-2">
			<?php include __DIR__ . '/../parts/aside.php'; ?>
		</div>
		<!-- 主要內容區 -->
		<div class="col-12 col-md-10">
			<?php include __DIR__ . '/../parts/breadcrumb.php'; ?>
			<?php include __DIR__ . '/parts/navbar.php'; ?>

			<main class="d-flex w-100">
				<div class="container d-flex flex-column">
					<div class="row vh-100">
						<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
							<div class="d-table-cell align-middle">

								<div class="text-center mt-4">
									<h1 class="h2">會員註冊</h1>
								</div>
								<p>
									*必填
								</p>
								<div class="card">
									<div class="card-body">
										<div class="m-sm-4">
											<form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">

												<div class="mb-3">
													<label for="pic" class="form-label">上傳圖片</label>
													<input class="form-control form-control-lg" type="text" id="pic" name="Mpic" />
													
												</div>
												<div class="mb-3">
													<label for="name" class="form-label">姓名</label>
													<input class="form-control form-control-lg" type="text" id="name" name="Mname" />
												</div>
												<div class="mb-3">
													<label for="identity">身分證</label>
													<input class="form-control form-control-lg" type="text" id="identity" name="Midentity">
												</div>
												<div class="mb-3">
													<label class="form-label">性別</label>
													<br>
													<input type="radio" id="male" name="Msex" value="男" checked>
													<label for="male">男</label>
													<input type="radio" id="female" name="Msex" value="女">
													<label for="female">女</label>
												</div>

												<div class="mb-3">
													<label for="vocation" class="form-label">職業</label>
													<input class="form-control form-control-lg" type="text"  id="vocation" name="Mvocation" />
												</div>

												<div class="mb-3">
													<label for="birthday">出生年月日</label>
													<input type="date" id="birthday" name="Mbirthday">
												</div>
												<div class="mb-3">
													<label for="city" class="form-label">居住城市</label>
													<input class="form-control form-control-lg" type="text" id="city" name="Mcity" />
												</div>
												<div class="mb-3">
													<label for="address" class="form-label">居住地址</label>
													<input class="form-control form-control-lg" type="text" id="address" name="Maddress" />
												</div>
												<div class="mb-3">
												<label class="form-label">婚姻狀況</label>
												<input type="radio" id="marry" name="Mmarry" value="未婚" checked>
												<label for="marry">未婚</label>
												<input type="radio" id="single" name="Mmarry" value="已婚">
												<label for="single">已婚</label>
												</div>

												<div class="mb-3">
												<label class="form-label">有無子嗣</label>
												<input type="radio" id="have" name="Mchild" value="無小孩" checked>
												<label for="have">無小孩</label>
												<input type="radio" id="havent" name="Mchild" value="有小孩" >
												<label for="havent">有小孩</label>
												</div>

												<div class="mb-3">
													<label for="email" class="form-label">Email</label>
													<input  class="form-control form-control-lg" type="email"  id="email" name="Memail" />
												</div>
												<div class="mb-3">
													<label for="phone" class="form-label">手機號碼</label>
													<input class="form-control form-control-lg" type="text" id="phone" name="Mphone" />
												</div>

												<div class="mb-3">
													<label for="password" class="form-label">密碼</label>
													<input class="form-control form-control-lg" type="text" id="password" name="Mpassword" />
												</div>



												<button type="submit" class="btn btn-primary">新增</button>


											</form>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>

				</div>
			</main>
		</div>
	</div>
	<?php include __DIR__ . '/../parts/script.php'; ?>
	<script>
		// const mobile = document.form1.mobile; // DOM element
		// const mobile_msg = mobile.closest('.mb-3').querySelector('.form-text');

		// const name = document.form1.name;
		// const name_msg = name.closest('.mb-3').querySelector('.form-text');

		function checkForm() {
			let isPass = true; // 有沒有通過檢查

			// name_msg.innerText = '';  // 清空訊息
			// mobile_msg.innerText = '';  // 清空訊息

			// TODO: 表單資料送出之前, 要做格式檢查

			// if (name.value.length < 2) {
			// 	isPass = false;
			// 	name_msg.innerText = '請填寫正確的姓名'
			// }

			// const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/; // new RegExp()
			// if(mobile.value){
			//     // 如果不是空字串就檢查格式
			//     if(! mobile_re.test(mobile.value)){
			//         mobile_msg.innerText = '請輸入正確的手機號碼';
			//         isPass = false;
			//     }
			// }

			if (isPass) {
				const fd = new FormData(document.form1);

				fetch('mem-add-api.php', {
						method: 'POST',
						body: fd
					}).then(r => r.json())
					.then(obj => {
						console.log(obj);
						if (obj.success) {
							alert('新增成功');
							location.href = 'member-list2.php';
						} else {
							alert('新增失敗');
						}

					})


			}


		}
	</script>

	<?php include __DIR__ . '/../parts/html-foot.php'; ?>