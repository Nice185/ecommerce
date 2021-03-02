
<div class="row" style="height:600px; width:250px;">
 <aside class="sidebar sidebar-left collapse navbar-collapse sidebarLeft">

            <!-- Sidebar Wrapper -->
            <div class="sidebar-wrapper">

                <div class="sidebar-nav-wrapper">
                  
                    <ul class="sidebar-nav"> 

                        <!-- Menu Item -->
                        <li class="border-left-green">
                            <a href="#" title="Dashboard">
                                <h3>CATEGORIES</h3>
                            </a>
                        </li>  
						<?php 
						$num_rows_cat = mysqli_num_rows($result_cat);
						while($row_cat = mysqli_fetch_array($result_cat)){
							$query_fam = "
							SELECT * FROM famille
							WHERE codeCat='".$row_cat['codecateg']."'
							";
							$result_fam= mysqli_query($connect, $query_fam);
							$num_rows_fam = mysqli_num_rows($result_fam);
							?>
                        <li class="border-left-red-"> 
                            <!-- 'data-target' attribute must mactch the id of the submenu dropdown  -->
                             <?php if($num_rows_fam>=1){?>
							<a href="javascript:void(0);" data-toggle="collapse" data-target="#<?php echo $row_cat['codecateg'];?>" title="UI Elements">
                                <i class="menu-icon fa fa-lg fa-fw fa-desktop"></i> <span><?php echo $row_cat['libcateg'];?></span>
                                <i class="fa fa-caret-right submenu-indicator"></i>
                            </a><?php } else {?>
								  <a href="index1.php?code=1&&codecat=<?php echo "
                      <li><a href='category.php?category=".$row_cat['cat_slug']."'>".$row_cat['libcateg']."</a></li>
                    ";         ?>"></a>
								 <?php } ?>
                            <!-- Sub Menu Item -->
							 <ul id="<?php echo $row_cat['codecateg'];?>" class="collapse"> 
							<?php 
							while($row_fam = mysqli_fetch_array($result_fam)){
								$query_sfa = "
								 SELECT * FROM sous_famille
								 WHERE codeFamille='".$row_fam['codeFamille']."'
								";
								$result_sfa= mysqli_query($connect, $query_sfa);
								$num_rows_sfa = mysqli_num_rows($result_sfa);
								?>
                                <li>
                                    <?php if($num_rows_sfa>=1){?> 
									<a href="javascript:void(0);" data-toggle="collapse" data-target="#<?php echo $row_fam['codeFamille'];?>" title="Icons">
                                        <span><?php echo $row_fam['libelFamille']; ?></span>
                                       <i class="fa fa-caret-right submenu-indicator"></i>
                                    </a>
									<?php }else{ ?>
									 <a href="index1.php?code=1&&codefam=<?php echo $row_fam['codeFamille']; ?>"><?php echo $row_fam['libelFamille']; ?></a>
								 <?php } ?>
                                    <ul id="<?php echo $row_fam['codeFamille'];?>" class="collapse">  
										<?php while($row_sfa = mysqli_fetch_array($result_sfa)){
											$query_art = "
											SELECT * FROM article
											WHERE codeSousFamille='".$row_sfa['codeSousFamille']."'
											";
											$result_art= mysqli_query($connect, $query_art);
											$num_rows_art = mysqli_num_rows($result_art);
											?>
                                        <!-- Menu Item -->
                                        <li>
											 <?php if($num_rows_art>=1){?> 
											<a href="javascript:void(0);" data-toggle="collapse" data-target="#<?php echo $row_sfa['codeSousFamille'];?>" title="Icons">
												<span><?php echo $row_sfa['libelSousFamille']; ?></span>
											    <i class="fa fa-caret-right submenu-indicator"></i>
											</a>
											<?php }else{?>
											  <a href="index1.php?code=1&&codesfa=<?php echo $row_sfa['codeSousFamille']; ?>"><?php echo $row_sfa['libelSousFamille']; ?></a>
											<?php } ?>
                                             <ul id="<?php echo $row_sfa['codeSousFamille'];?>" class="collapse">
										<?php while($row_art = mysqli_fetch_array($result_art)){?>
                                        <!-- Menu Item -->
											<li>
											 <a href="index1.php?code=1&&codeart=<?php echo $row_art['codeArt']; ?>"><?php echo $row_art['libelArt']; ?></a>
											</li> 
												<?php } ?>
											 </ul>
                                        </li> 
										<?php } ?>
                                        <!-- End Menu Item -->
                                    </ul>
                                </li> 
							<?php }?>
                               
                            </ul>
                        </li> 
						<?php } ?>
					</ul>
                </div> 
                
            </div>

        </aside>
</div>
  