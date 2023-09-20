<!DOCTYPE html>
<html lang="en">

<head>
    @include('backoffice.layouts.header')
    @yield('style')
    <link rel="stylesheet" href="css/backoffice/main-admin.css">
    <title>admin</title>
</head>

<body class="bg-light">
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between align-items-center">
                <h1 class="fs-5"><span class="bg-white text-dark rounded shadow px-2 me-2">CL</span><span
                        class="text-white">Hotel Booking</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="bi bi-list"
                        style="font-size: 30px;"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class=""><a href="javascript:getPage('')" class="text-decoration-none px-3 py-2 d-block"><i
                            class="bi bi-house-door" style="font-size: 20px;"></i> Dashboard</a></li>
                <li class="rooms"><a href="javascript:getPage('rooms')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-hospital"
                            style="font-size: 20px;"></i> Rooms</a></li>
                <li class="users"><a href="javascript:getPage('users')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-people"
                            style="font-size: 20px;"></i> Users</a></li>
                <li class="messages"><a href="javascript:getPage('messages')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-chat-right-text"
                            style="font-size: 20px;"></i> Messages</a></li>
                <li class="carousel"><a href="javascript:getPage('carousel')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-images"
                            style="font-size: 20px;"></i> Carousel</a></li>
                <li class="settings"><a href="javascript:getPage('settings')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-sliders"
                            style="font-size: 20px;"></i> Settings</a></li>
            </ul>
            <hr class="h-color mx-2">
        </div>

        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light nav-bg">
                <div class="container-fluid justify-content-md-end justify-content-between">
                    <div class="d-flex justify-content-between d-md-none d-block align-items-center">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="bi bi-list"
                                style="font-size: 30px;"></i></button>
                        <a href="/admin" class="navbar-brand fs-4"><span
                                class="bg-dark rounded px-2 py-0 text-white">CL</span></a>
                    </div>

                    <div class="profile bg-light">
                        <div>
                            <img src="/images/backoffice/user.png">

                            <div class="frofile-card shadow rounded bg-white">
                                <div class="details d-flex gap-2 align-items-center p-3 w-100 h-75">
                                    <img class="img" src="/images/backoffice/user.png">
                                    <div class="text-center d-flex flex-column justify-content-center">
                                        <p class="display">{{ $shareUser->display_name }}</p>
                                        <span class="email">{{ $shareUser->username }}</span>
                                    </div>
                                </div>
                                <button onclick="onLogout()"
                                    class="action w-100 h-25 bg-dark text-light d-flex gap-2 align-items-center justify-content-center" style="border: none;">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span class="">ออกจากระบบ</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="dashboard-content container-fluid px-3 pt-4">

                @yield('content')

            </div>
        </div>
    </div>






    {{-- <div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
        <h3 class="">ระบบจัดการหลังบ้าน</h3>
        <button class="btn btn-light btn-sm shadow-none" onclick="onLogout()">
            <span class="spinner spinner-border spinner-border-sm hidden text-dark" aria-hidden="true"></span> ออกจากระบบ
        </button>
    </div>


    <div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid flex-lg-column align-items-stretch">
                <h4 class="mt-2 text-light">ADMIN PANEL</h4>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis quas voluptatem illum quam laborum sit. Labore voluptas quasi quos obcaecati amet molestias vero, quaerat ex dignissimos optio accusamus vitae ipsa quas sed quidem praesentium minima magni aspernatur quis officiis! Quas, impedit saepe, explicabo adipisci totam porro ab numquam in beatae reiciendis accusantium, vel iusto. Qui, ipsa aperiam. Ab quod debitis aperiam, sint voluptate fugit pariatur? Hic veritatis qui eligendi, rerum, nihil obcaecati cupiditate aut illo architecto quaerat accusantium quod adipisci dolor neque dignissimos alias assumenda. Quae enim voluptas iusto similique? Aliquid facilis ratione officiis et commodi tempore autem quo, in necessitatibus nisi magni distinctio quas at beatae voluptates optio similique. Hic dolorum molestias officia eveniet iure, quia vero, atque, aperiam sapiente suscipit recusandae vel exercitationem sint vitae. Pariatur modi praesentium enim magni, nisi nobis ducimus et voluptatibus natus fugit commodi libero consectetur doloribus fugiat aspernatur consequatur debitis neque dolorum nihil amet in tempore aperiam molestias? Dignissimos porro, sint, facilis similique quibusdam fugit expedita adipisci quia libero sed reiciendis minima reprehenderit illo asperiores dolorem et quos illum qui fugiat autem atque sit. Facere debitis aut corporis velit vero repellat, molestiae, est minima cumque laboriosam eveniet sapiente, esse possimus sequi? Eos cumque mollitia ex fugit eligendi minima numquam, asperiores voluptates aliquid odit natus dignissimos doloribus voluptate saepe repudiandae quod esse! Suscipit exercitationem incidunt, quo illum adipisci commodi cum autem minima, unde, sit voluptate sint sunt repellat fugiat sed perspiciatis ad. Alias ipsam odio harum! Exercitationem aperiam quam, deleniti itaque molestias distinctio molestiae? Non magnam numquam sequi facilis magni placeat exercitationem quae odit, est quidem, deleniti dolor quaerat ipsum quisquam odio delectus. Corporis aperiam debitis voluptates deserunt alias voluptatum, obcaecati impedit natus rem ut sit magnam illo quaerat dolorem porro iste nobis dolore voluptas cumque exercitationem dolor animi? Neque quas perspiciatis aperiam, ab fugiat eveniet quae tenetur doloremque aliquid quisquam molestias sunt architecto ipsum obcaecati odio dolores maiores in tempora eos mollitia? Nemo amet officia nam mollitia libero sapiente quod doloremque repellendus reprehenderit exercitationem magnam voluptates natus eos, nihil, odio dolor! Pariatur dignissimos perferendis magni repellat deserunt. Temporibus vel officia nihil dolore esse itaque error velit. Dolores voluptatum error soluta! Assumenda ducimus officia tenetur quod architecto labore veritatis blanditiis sit fuga, aspernatur fugiat nihil sequi aliquid consequuntur iste repellendus doloremque delectus neque nobis minima odio ipsum? Totam numquam est consequatur delectus iste ipsa minus dolorum sapiente? Dignissimos praesentium asperiores necessitatibus nesciunt sequi omnis non consequatur est, voluptatibus iste ipsum minus culpa tenetur aliquid at tempore magni reiciendis quis itaque voluptatum. Voluptates doloremque id repudiandae autem, fuga modi quibusdam facere iste dicta consequuntur ut nulla molestiae necessitatibus vero, eaque cumque dolorem quia illo ad minima sapiente? Ad aspernatur sunt voluptate deserunt eius nulla animi, aliquam atque laboriosam eum repellat nihil eaque? Est, deleniti nostrum. Veritatis fuga enim libero, modi itaque debitis impedit blanditiis inventore totam qui provident aperiam facere porro sapiente voluptates, ab fugiat! Nesciunt in incidunt a vero, dolor, tempore ratione, adipisci beatae reprehenderit sequi magnam qui mollitia saepe recusandae enim omnis iure reiciendis. Facere animi suscipit nisi illo, delectus dolorem architecto dignissimos quia beatae, explicabo eveniet magnam nemo reiciendis cupiditate repudiandae doloremque velit similique porro consequatur! Ipsa dicta, eum saepe inventore, perspiciatis rerum suscipit est magnam veniam voluptatem praesentium similique, aperiam facere corporis laudantium delectus in totam minima ratione? Omnis voluptatibus optio non! Dolorem repellat accusantium, temporibus aperiam debitis distinctio numquam velit quos minima placeat tempora ipsam laborum iste cumque consectetur in magni reiciendis amet? Itaque quasi corporis qui, facere nemo veritatis neque iure nesciunt placeat quia ad. Dolores porro beatae omnis iste praesentium, in corrupti provident nam eum tempore voluptas a soluta commodi, illo exercitationem consequatur tempora deserunt quae temporibus. Itaque quaerat sapiente temporibus totam deleniti aperiam doloremque, atque perferendis adipisci eos. Suscipit corrupti magnam numquam asperiores quasi molestiae, soluta at quisquam delectus omnis nesciunt voluptatibus saepe dolor. Ipsum molestiae corporis laudantium, ea illum numquam ex. Dolores tempora quaerat quam sed ab ipsum cum animi, corrupti iure error iusto. Voluptatum totam, voluptatem odio placeat perferendis aliquam illo cum? At minima quas quod voluptates beatae voluptatibus dolor eligendi eveniet aspernatur quo illo nihil tempore commodi, adipisci eum optio natus molestiae suscipit laboriosam, consequuntur maxime ratione veritatis est! Molestiae sequi ea asperiores nobis. Ex veritatis itaque quod impedit vitae corrupti soluta illum nisi delectus alias sequi, odio, hic quae animi molestias culpa quo odit enim amet dolore error? Non nam quidem beatae, hic eius sapiente? Vero, perferendis. Ratione corporis molestias quae dolorum at deleniti veniam accusantium distinctio obcaecati dolore dolorem dignissimos impedit dicta beatae earum ut omnis delectus commodi officia, a magni nobis perferendis! Ratione non quaerat esse ipsa sapiente, rem possimus velit. Dignissimos ipsa omnis veniam consequatur culpa ea nulla iure? Quae distinctio rem sint quam soluta esse laborum autem qui cupiditate iusto quasi, dolor veritatis eum quis animi velit. Quod, unde recusandae temporibus praesentium molestiae modi. Consequatur quibusdam pariatur beatae saepe expedita at sunt perferendis ipsa exercitationem natus, eveniet omnis alias deleniti facilis ea eos nobis illum tenetur ipsam quia delectus inventore optio error? Atque error laudantium beatae alias odio voluptatibus saepe temporibus voluptatem quos hic quis facilis fuga nesciunt corrupti praesentium ipsam, ipsum neque mollitia ea, earum debitis, commodi ab? Aliquid ipsum recusandae expedita officiis. Voluptatibus dolorem minima aperiam dolores quae. Aut architecto ipsa odit consequuntur fugiat hic voluptatibus, rem dolor dolorem aspernatur quibusdam pariatur in cum quos repellendus aliquid nam facere magni excepturi ea vero consectetur illo quidem iusto! Enim, modi animi. Dolor voluptas ipsam, natus asperiores voluptates odit, quaerat distinctio, consequatur eos laborum iure tempora atque autem aperiam non. Dolores harum similique perferendis quae beatae optio, porro repellendus velit eius temporibus quibusdam sit eos laborum! Rem ipsa necessitatibus eveniet distinctio aliquam nisi asperiores consectetur sed ut esse? Alias ut nam hic, ipsam laudantium voluptatibus! Qui, quae voluptas. Iusto ad doloribus totam tempore, maiores, dolorem, illo est commodi quod aliquid itaque! Dolorum quas voluptatibus facilis sapiente quo vero inventore beatae ut iusto repellat repellendus magni repudiandae aperiam officia sit minima perferendis, voluptatum dolore? Doloremque hic, atque illo molestias perferendis dolor perspiciatis laudantium nesciunt in ratione repudiandae libero deleniti, expedita magni eligendi quia omnis tempora, soluta quos minima ducimus voluptas provident illum ipsam. Ullam dolorem impedit doloremque eius minus tempore ipsa autem, recusandae dicta! Iste accusamus libero vero alias ex quo qui soluta odit temporibus repellat deserunt mollitia omnis, maxime debitis rerum amet aliquam labore ut ipsam? Ab odio quas facilis possimus, tempora ducimus deleniti nobis fugiat incidunt minima dicta nemo ex? Reiciendis a incidunt earum ipsum animi recusandae obcaecati perferendis repudiandae! Nihil quo quis magnam in officia voluptate repellendus quod autem ipsum, voluptatum nostrum fugiat commodi vel pariatur odio molestiae veniam et illum culpa blanditiis quae. Sequi quia consectetur fuga amet, nihil quibusdam error in minima fugit cupiditate quaerat unde officia aut repellendus! At molestiae fugiat, incidunt praesentium delectus autem placeat ipsa impedit quisquam nulla doloribus voluptatem vel libero eum tempore error maxime iste ut ullam odio? Odit, cum nemo? Quae ex ipsa, quibusdam corrupti culpa nesciunt hic tenetur obcaecati impedit laborum quisquam recusandae vero. Natus iusto error distinctio iste omnis possimus debitis maxime magnam, aliquam laudantium nisi necessitatibus quae! Harum magni autem, aut alias architecto, aliquid ipsam nihil nesciunt similique ducimus deleniti, porro quia voluptate odio minima. Expedita tempore numquam praesentium, quaerat excepturi ipsa facere nemo, pariatur sunt laudantium harum optio incidunt! Corporis eligendi aut officia vel sint rerum itaque reprehenderit maxime animi doloribus error amet perspiciatis tempora, eos at vitae assumenda libero beatae eius accusamus iste laudantium, sed molestias? Commodi officia accusantium consequatur asperiores. Ad eius sapiente natus veritatis asperiores exercitationem cupiditate praesentium omnis perferendis hic sed repellat reprehenderit quos quis, modi totam, numquam ratione quidem sit! Ducimus illum officia odio quo nam dolorum magnam consequuntur, vero ut nesciunt, cupiditate illo impedit a dolores, deserunt culpa explicabo aut possimus autem expedita vitae numquam. Sunt, eum architecto corrupti numquam repellendus expedita, tenetur illo debitis asperiores accusantium commodi nobis incidunt optio, aliquam reiciendis deleniti eos itaque placeat magni amet libero possimus. Sit error a consectetur ex suscipit ullam distinctio! Dolor, deleniti? Itaque dolor omnis, sit provident tempore, deserunt quae nemo temporibus, corporis ad magni est error repudiandae perferendis ratione culpa quaerat magnam quisquam amet tempora pariatur accusamus officiis libero. Sequi voluptate consectetur, magnam suscipit ullam est fugit eveniet facere, recusandae tempore, corporis ad optio amet et id odit. Voluptatibus earum, veniam animi aspernatur iusto, quos pariatur accusamus repellendus tempora repudiandae hic quis in eos voluptates suscipit voluptas, cumque natus quo ducimus veritatis labore! Sunt et omnis suscipit similique reiciendis. Odit optio accusamus minus pariatur quidem, hic aperiam numquam a quis mollitia recusandae eos quo deserunt possimus quia, ab reprehenderit expedita neque esse atque. Dolor ut maxime ex excepturi? Quibusdam ex minus deleniti sed et harum itaque quisquam asperiores, officia aut eaque corporis. Necessitatibus tempore, nemo a hic voluptatibus facere deserunt temporibus ullam illo nam possimus esse saepe illum dolore totam commodi pariatur expedita perferendis ad. Unde et maxime autem tempora veniam at provident expedita facilis omnis voluptas voluptate iusto, natus quod illo ab laboriosam odit dolor harum? Soluta minus laborum minima, esse non ut recusandae natus doloremque qui! Fuga numquam itaque atque quisquam voluptatibus distinctio culpa saepe nesciunt esse! Sint reprehenderit voluptatum error adipisci facere, cum facilis laborum dolore dolorem quae, doloribus aperiam eum tempore beatae! Illo dolor reprehenderit facere voluptates consequuntur fuga deleniti, accusantium temporibus tempore suscipit, cum asperiores laborum iusto eos in fugiat, ad fugit. Explicabo mollitia dolorum corrupti voluptatibus dignissimos repudiandae debitis placeat. Nostrum, fugit laborum delectus corrupti quos commodi est blanditiis sit totam harum amet. Illo commodi eveniet, hic ea natus doloribus, quisquam aut nihil ab minus ducimus inventore aliquam itaque sequi veniam nam dolor pariatur totam reiciendis explicabo error! Unde laboriosam, fugiat nulla quae eos impedit praesentium sit exercitationem similique. Blanditiis sit omnis iure sint numquam molestiae saepe similique quo magni rerum dolorum autem quis incidunt vitae fugiat recusandae voluptates inventore, aut maxime nostrum. Obcaecati illum nostrum quos labore est et! Inventore molestias odio sunt placeat magnam quo repellendus ratione dolorem, dicta iste, mollitia vitae ducimus hic, aliquid omnis asperiores totam corporis possimus officia optio. Est, itaque porro. Ipsum voluptates culpa, corrupti eos libero beatae at quas quaerat delectus ut expedita officiis, ratione dolores? Facere mollitia alias quaerat cumque assumenda ipsa placeat obcaecati tempore nihil tenetur nam quisquam cum corrupti officia ex neque sint, illo harum magnam, quod officiis sit? Sit magni placeat praesentium rem itaque fugiat magnam nulla corporis illo! Reprehenderit nobis dolor dolorem impedit rerum, molestiae optio consequuntur commodi qui quam ullam praesentium explicabo natus. Totam deserunt libero cum, voluptates vitae nihil numquam suscipit blanditiis dolore nemo ad recusandae illo, magnam saepe maxime minima explicabo porro, nam placeat voluptatibus. Voluptate, officia dolorum! Eligendi omnis doloremque adipisci deserunt magni eos aperiam error? Animi harum excepturi exercitationem quos, obcaecati architecto perspiciatis nisi sit porro quidem minus tempore praesentium, illum, iure alias atque hic dolorem ut sed ipsum voluptas natus nihil odit doloribus. In eveniet nostrum explicabo consectetur optio. Mollitia, ratione! Perferendis quaerat optio quisquam deleniti nesciunt voluptatem facilis, sint ea ut odio qui ducimus nemo. Cum, ab. Dignissimos assumenda quaerat, enim iusto amet asperiores facere placeat facilis, mollitia, beatae impedit harum in eos minima reprehenderit nihil? Blanditiis provident explicabo quaerat ipsum, doloremque, quis adipisci perferendis facilis numquam quam expedita asperiores itaque quo voluptates sunt, iure in iste obcaecati fugit amet non deleniti error sequi magni. Perferendis aspernatur accusantium quos perspiciatis ab veniam fuga expedita ad et iure, aperiam mollitia impedit magni, error deserunt natus pariatur nisi dolorum? Quod dolore, dolor maiores beatae vitae porro temporibus quia exercitationem illum, at magnam error, voluptatem numquam voluptatibus totam repudiandae dolorum iusto. Voluptatum consequuntur quam minima maiores mollitia excepturi quisquam natus qui! Impedit nobis, similique officiis qui consectetur totam asperiores quia, nostrum ea, alias velit iste dolor aut fuga sequi optio hic animi aliquam veritatis quibusdam commodi nemo repudiandae eaque. Aliquid ut placeat dignissimos! Inventore ipsa explicabo eos facere voluptas consectetur asperiores pariatur accusamus aliquam ut veniam, ea quo libero numquam dicta quod molestias possimus architecto necessitatibus sunt? Praesentium deleniti vitae alias provident voluptas cupiditate magni porro dicta!
            </div>
        </div>
    </div> --}}

    @include('backoffice.layouts.scripts')

    <script>

        const queryString = window.location.search;
        const params = new URLSearchParams(queryString);
        const paramValue = params.get('page');

        function activeMenu() {
            $(".sidebar ul li").on('click', function() {
                $(this).addClass('active');
                $('.sidebar ul li.active').removeClass('active');
            })
        }

        document.querySelectorAll('.sidebar ul li').forEach(function(el, ind) {

            if ((el.className === paramValue) || (!paramValue && el.className === "")) {
                el.classList.add('active')
            } else {
                el.classList.remove('active')
            }
        })

        function getPage(_page) {

            if ((_page === paramValue) || (_page === "" && !paramValue)) return false;

            activeMenu();
            if (_page) {
                window.location.href = `/admin?page=${_page}`
            } else {
                window.location.href = `/admin`
            }
        }
    </script>

    @yield('script')

</body>

</html>
