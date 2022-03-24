<?php
require __DIR__ . '/../parts/connect_db.php';
$title = 'Edit';
$systemName = '會員管理系統';
$systemitem = '會員修改';

$mid = isset($_GET['MID']) ? intval($_GET['MID']) : 0;

$sql = "SELECT * FROM member WHERE MID=$mid";

$row = $pdo->query($sql)->fetch();

if(empty($row)){
    header('Location:member-list2.php'); // 找不到資炓轉向列表頁
    exit;
}
// ?>
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
									<h1 class="h2">會員修改</h1>
								</div>
								<p>
									*必填
								</p>
								<div class="card">
									<div class="card-body">
										<div class="m-sm-4">
											<form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
											<input type="hidden" name="MID" value="<?=$row['MID']?>">
												<div class="mb-3">
													<label for="pic" class="form-label">上傳圖片</label>
													<input class="form-control form-control-lg" type="text" id="pic" name="Mpic" value="<?= htmlentities($row['Mpic'])?>" />
													
												</div>
												<div class="mb-3">
													<label for="name" class="form-label">*姓名</label>
													<input class="form-control form-control-lg" type="text" id="name" name="Mname" required value="<?=htmlentities($row['Mname'])?>" >
                                                    
												</div>
												<div class="mb-3">
													<label for="identity">身分證</label>
													<input class="form-control form-control-lg" type="text" id="identity" name="Midentity" value="<?=htmlentities($row['Midentity'])?>" >
												</div>
												<div class="mb-3">
													<label class="form-label">性別</label>
													<br>
													<input type="radio" id="male" name="Msex" value="男" <?php if($row ['Msex']=="男") echo"checked" ;?>>
													<label for="male">男</label>
													<input type="radio" id="female" name="Msex" value="女" <?php if($row ['Msex']=="女") echo"checked" ;?>>
													<label for="female">女</label>
												</div>

												<div class="mb-3">
													<label for="vocation" class="form-label">職業</label>
													<input class="form-control form-control-lg" type="text"  id="vocation" name="Mvocation" value="<?=htmlentities($row['Mvocation'])?>" />
												</div>

												<div class="mb-3">
													<label for="birthday">出生年月日</label>
													<input type="date" class="form-control" id="birthday" name="Mbirthday" value="<?=htmlentities($row['Mbirthday'])?>" >
												</div>
												<div class="mb-3">
													<label for="city" class="form-label">居住城市</label>
													<input class="form-control form-control-lg" type="text" id="city" name="Mcity" value="<?=htmlentities($row['Mcity'])?>" />
												</div>
												<div class="mb-3">
													<label for="address" class="form-label">居住地址</label>
													<input class="form-control form-control-lg" type="text" id="address" name="Maddress" value="<?=htmlentities($row['Maddress'])?>" />
												</div>
												<div class="mb-3">
												<label class="form-label">婚姻狀況</label>
												<input type="radio" id="marry" name="Mmarry" value="已婚" <?php if($row ['Mmarry']=="已婚") echo"checked" ;?>>
												<label for="marry">已婚</label>
												<input type="radio" id="single" name="Mmarry" value="未婚" <?php if($row ['Mmarry']=="未婚") echo"checked" ;?>>
												<label for="single">未婚</label>
												</div>

												<div class="mb-3">
												<label class="form-label">有無子嗣</label>
												<input type="radio" id="have" name="Mchild" value="有小孩"  <?php if($row ['Mchild']=="有小孩") echo"checked" ;?>>
												<label for="have">有小孩</label>
												<input type="radio" id="havent" name="Mchild" value="無小孩" <?php if($row ['Mchild']=="無小孩") echo"checked" ;?>>
												<label for="havent">無小孩</label>
												</div>

												<div class="mb-3">
													<label for="email" class="form-label">Email</label>
													<input  class="form-control form-control-lg" type="email"  id="email" name="Memail" value="<?=htmlentities($row['Memail'])?>" />
												</div>
												<div class="mb-3">
													<label for="phone" class="form-label">手機號碼</label>
													<input class="form-control form-control-lg" type="text" id="phone" name="Mphone" value="<?=htmlentities($row['Mphone'])?>" />
												</div>

												<div class="mb-3">
													<label for="password" class="form-label">密碼</label>
													<input class="form-control form-control-lg" type="text" id="password" name="Mpassword" value="<?=htmlentities($row['Mpassword'])?>" />
												</div>



												<button type="submit" class="btn btn-primary">修改</button>


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
		function checkForm() {
			let isPass = true; // 有沒有通過檢查


			if (isPass) {
				const fd = new FormData(document.form1);

				fetch('mem-edit-api.php', {
						method: 'POST',
						body: fd
					}).then(r => r.json())
					.then(obj => {
						console.log(obj);
						if (obj.success) {
							alert('修改成功');
							location.href = 'member-list2.php';
						} else {
							alert('修改失敗');
						}

					})


			}


		}
	</script>

	<?php include __DIR__ . '/../parts/html-foot.php'; ?>