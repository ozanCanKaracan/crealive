<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ms-auto">
            <?php
            if (isset($_GET['lang'])) {
                $selectedLanguage = $_GET['lang'];
                $_SESSION['lang'] = $selectedLanguage;
            } elseif ($_SESSION['lang']) {
                $selectedLanguage = $_SESSION['lang'];
                $_SESSION['lang'] = $selectedLanguage;
            } else {
                $browserLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
                $result = substr($browserLanguage, 0, 2);
                $selectedLanguage = DB::getVar("SELECT lang_name_short FROM languages WHERE lang_name_short=?", [$result]);
                $_SESSION['lang'] = $selectedLanguage;
            }
            $fullName = DB::getVar("SELECT lang_name FROM languages WHERE lang_name_short=?", [$selectedLanguage]);
            $translate=(language($fullName)) ? language($fullName) : $fullName;
            ?>

            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-<?= $selectedLanguage ?>"></i><?= $translate ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                    <?php
                    $allLanguages = DB::get("SELECT * FROM languages");
                    foreach ($allLanguages as $language) {
                        $langName=$language->lang_name;
                        $translate=(language($langName)) ? language($langName) : $langName;
                        $languageShort = $language->lang_name_short;
                        $isActive = ($selectedLanguage == $languageShort) ? 'active' : '';
                        ?>
                        <a class="dropdown-item <?= $isActive ?>" href="?lang=<?= $languageShort ?>">
                            <i class="flag-icon flag-icon-<?= $languageShort ?>"></i><?= $translate ?>
                        </a>
                    <?php } ?>
                </div>
            </li>


            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                                                                                         data-feather="moon"></i></a>
            </li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
                                                                                   data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1"
                           data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>
            <?php
            $role_id = $_SESSION["role_id"];
            $id = $_SESSION["user"];
            $name = DB::getVar("SELECT name FROM users WHERE id=? ", [$id]);
            $roleName = DB::getVar("SELECT role_name FROM roles WHERE id=?", [$role_id]);
            ?>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                                                           id="dropdown-user" href="#" data-bs-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false">

                    <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder"><?= $name ?></span><span
                                class="user-status"><?= $roleName; ?></span></div>
                    <span class="avatar"><img class="round" src="app-assets/images/portrait/small/avatar-s-11.jpg"
                                              alt="avatar" height="40" width="40"><span
                                class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user"><a class="dropdown-item"
                                                                                                href="page-profile.html"><i
                                class="me-50" data-feather="user"></i> Profile</a><a class="dropdown-item"
                                                                                     href="app-email.html"><i
                                class="me-50" data-feather="mail"></i> Inbox</a><a class="dropdown-item"
                                                                                   href="app-todo.html"><i class="me-50"
                                                                                                           data-feather="check-square"></i>
                        Task</a><a class="dropdown-item" href="app-chat.html"><i class="me-50"
                                                                                 data-feather="message-square"></i>
                        Chats</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="page-account-settings-account.html"><i class="me-50"
                                                                                          data-feather="settings"></i>
                        Settings</a><a class="dropdown-item" href="page-pricing.html"><i class="me-50"
                                                                                         data-feather="credit-card"></i>
                        Pricing</a><a class="dropdown-item" href="page-faq.html"><i class="me-50"
                                                                                    data-feather="help-circle"></i> FAQ</a>
                    <?php
                    $lang=$_SESSION['lang'];
                    $language=DB::getVar("SELECT id FROM languages WHERE lang_name_short=?",[$lang]);
                    ?>
                    <a class="dropdown-item" href="#" onclick="logout(<?=$language?>)"><i class="me-50" data-feather="power"></i>
                        Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center"><a href="#">
            <h6 class="section-label mt-75 mb-0">Files</h6>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="app-assets/images/icons/xls.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing
                        Manager</small>
                </div>
            </div>
            <small class="search-data-size me-50 text-muted">&apos;17kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="app-assets/images/icons/jpg.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd
                        Developer</small>
                </div>
            </div>
            <small class="search-data-size me-50 text-muted">&apos;11kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="app-assets/images/icons/pdf.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital
                        Marketing Manager</small>
                </div>
            </div>
            <small class="search-data-size me-50 text-muted">&apos;150kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="app-assets/images/icons/doc.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                </div>
            </div>
            <small class="search-data-size me-50 text-muted">&apos;256kb</small>
        </a></li>
    <li class="d-flex align-items-center"><a href="#">
            <h6 class="section-label mt-75 mb-0">Members</h6>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                                   href="app-user-view-account.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="app-assets/images/portrait/small/avatar-s-8.jpg" alt="png"
                                               height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                                   href="app-user-view-account.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="app-assets/images/portrait/small/avatar-s-1.jpg" alt="png"
                                               height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd
                        Developer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                                   href="app-user-view-account.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="app-assets/images/portrait/small/avatar-s-14.jpg" alt="png"
                                               height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing
                        Manager</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                                   href="app-user-view-account.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="app-assets/images/portrait/small/avatar-s-6.jpg" alt="png"
                                               height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                </div>
            </div>
        </a></li>
</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between"><a
                class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No results found.</span>
            </div>
        </a></li>
</ul>
<!-- END: Header-->
<script src="assets/js/modules/auth.js"></script>
