<?
include "includes.php";
$logoAdminPath = BASE_ADMIN_URL;
$urlPath = BASE_URL;
?>
<table border="0" cellpadding="0" cellspacing="0" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#333333; margin:0 auto; padding:0;" width="860">
	<tbody>
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#333333; margin:0 auto; padding:0; border:10px solid #666666; background:#fcf4df;" width="800">
					<tbody>
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" width="800" style="box-shadow:1px 1px 4px #666666; -moz-box-shadow:1px 1px 4px #666666; -webkit-box-shadow:1px 1px 4px #666666;">
									<tbody>
										<tr>
											<td>
												<a href="<?=$urlPath?>"><img alt="Yellow Train School" border="0" src="<?=$logoAdminPath?>/newsletter/images/logo.jpg" /></a></td>
											<td>
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="height:66px;" valign="top"><img alt="Yellow Train School" border="0" src="<?=$logoAdminPath?>/newsletter/images/header1.jpg" /></td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
                        
						<tr>
							<td> 
								<table width="745" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; padding:12px 0;">
                                  <tr>
                                    <td colspan="3"><? include $fileName; ?></td>
								  </tr>
                                </table>
							</td>
						</tr>
                        

						<tr>
							<td style="background:#cfa871;">
								<table border="0" cellpadding="0" cellspacing="0" style="color:#FFFFFF; font-size:14px; margin:0 auto; padding:17px 0;" width="745">
									<tbody>
										<tr>
											<td align="left">
												<a href="<?=$urlPath?>" style="text-decoration:none; color:#FFFFFF;">www.yellowtrainschool.com</a></td>
											<td align="right">
												Copyright 2015. All Rights Reserved</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
 	</tbody>
</table>