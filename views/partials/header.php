<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ms-auto">
            <?php
            // Url'de lang parametresi var mı?
            // Var ise session'da tut.
            if (isset($_GET['lang'])) {
                $selectedLanguage = $_GET['lang'];
                $user_id = $_SESSION["user"];
                $languageID = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$selectedLanguage]);
                $control = DB::getVar("SELECT status FROM language_permission WHERE user_id=? AND language_id=? ", [$user_id, $languageID]);
                if ($control == 1) {
                    $_SESSION['lang'] = $selectedLanguage;
                } else {
                    $slug = $_GET["lang"];
                    echo "<script>window.location.href=''</script>";
                }
            } elseif ($_SESSION['lang']) {
                $selectedLanguage = $_SESSION['lang'];
            } else {
                $browserLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
                $result = substr($browserLanguage, 0, 2);
                $selectedLanguage = DB::getVar("SELECT lang_name_short FROM languages WHERE lang_name_short=? AND status=1", [$result]);
                $_SESSION['lang'] = $selectedLanguage;
            }

            $fullName = DB::getVar("SELECT lang_name FROM languages WHERE lang_name_short=? AND status=1", [$selectedLanguage]);
            $translate = (language($fullName)) ? language($fullName) : $fullName;
            $languageFlag = ($selectedLanguage == "en") ? "us" : $selectedLanguage;

            ?>

            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-<?= $languageFlag ?>"></i><?= $translate ?>

                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag" id="selectLanguage">
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
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <?php
                    $lang = $_SESSION['lang'];
                    $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);
                    ?>
                    <a class="dropdown-item" href="#" onclick="logout(<?= $language ?>)"><i class="me-50"
                                                                                            data-feather="power"></i>
                        Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- END: Header-->
<script src="assets/js/modules/auth.js"></script>
