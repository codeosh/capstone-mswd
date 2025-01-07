{{-- resources\views\page\beneficiary_site.blade.php --}}
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>MSWD</title>
        <link rel="stylesheet" href="{{asset('css/style.css')}}" />
        <link rel="stylesheet" href="{{asset('css/mediaQuery.css')}}" />
        <!-- AOS CDN -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
        <!-- Boostrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous" />
        <!-- Font Awesome CND -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
            integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <!-- Header Page -->
        <header>
            <nav>
                <div class="logoMSWD">
                    <img data-aos="zoom-in-top" data-aos-duration="1500" src="{{asset('images/logo/mswd-icon.png')}}"
                        alt="" />
                </div>
                <ul data-aos="zoom-in-top" data-aos-duration="1500" id="nav-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#Announcement">Announcement</a></li>
                    <li><a href="#AboutUs">About us</a></li>
                </ul>
                <div data-aos="zoom-in-top" data-aos-duration="1500" class="bars" id="bars-menu">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>

            <div class="heroPage">
                <h1 data-aos="zoom-in-top" data-aos-duration="1500">
                    Municipal Social Welfare and Development
                </h1>
                <p data-aos="zoom-in-top" data-aos-duration="1500">
                    Empowering communities through comprehensive support and sustainable
                    development initiatives for a brighter future.
                </p>
            </div>
        </header>
        <!-- Animation Pictures -->
        <div class="mswd-Images-container">
            <div data-aos="zoom-out-up" data-aos-duration="2000" class="mswd-images">
                <img src="{{asset('images/images/pic01.jpg')}}" alt="" />
                <img src="{{asset('images/images/pic02.jpg')}}" alt="" />
                <img src="{{asset('images/images/pic03.jpg')}}" alt="" />
                <img src="{{asset('images/images/pic04.jpg')}}" alt="" />
                <img src="{{asset('images/images/pic05.jpg')}}" alt="" />
                <!-- -->
                <img src="{{asset('images/images/pic01.jpg')}}" alt="" />
                <img src="{{asset('images/images/pic02.jpg')}}" alt="" />
                <img src="{{asset('images/images/pic03.jpg')}}" alt="" />
                <img src="{{asset('images/images/pic04.jpg')}}" alt="" />
                <img src="{{asset('images/images/pic05.jpg')}}" alt="" />
            </div>
        </div>

        <!-- Announcement Page -->
        <div class="Announcement" id="Announcement">
            <h1>Latest Announcements</h1>
            <p>
                Stay informed with the newest updates, programs, and activities from the
                Municipal Social Welfare and Development Office!
            </p>

            <div class="announcementContent"></div>
        </div>

        <!-- About Page -->
        <div class="aboutPage" id="AboutUs">
            <h1>About Us</h1>
            <div class="aboutUsMainContainer">
                <div class="leftContentAbout">
                    <img src="{{asset('images/images/pic01.jpg')}}" alt="About Us MSWD" />
                </div>
                <div class="rightContentAbout">
                    <p>
                        The Municipal Social Welfare and Development Office (MSWDO) of
                        Sogod, Southern Leyte is dedicated to promoting the well-being of
                        individuals, families, and communities. Through innovative programs
                        and compassionate services, the MSWDO works to uplift the
                        marginalized and empower residents to lead more dignified and
                        self-reliant lives. Committed to providing accessible social
                        services, implementing community-driven development initiatives, and
                        advocating for the rights and welfare of vulnerable groups, the
                        office plays a vital role in fostering social equity. By
                        collaborating with government agencies, non-governmental
                        organizations, and the local community, the MSWDO strives to create
                        a safer and more inclusive Sogod for everyone.
                    </p>
                </div>
            </div>
        </div>

        <!-- Mission/Vision Page -->
        <div class="Mission-Vision">
            <div class="Mission-Vision-Container">
                <div class="MissionContainer">
                    <div class="circleContainer">
                        <div class="circle"></div>
                    </div>
                    <div class="MissionContent">
                        <h1>Mission</h1>
                        <p>
                            To develop and enhance the psycho-social functioning and crucial
                            capability of the less privileged clientele thru Social Work
                            Intervention, Community Mobilization and Accessing to Livelihood
                            Program. To improve family relationship and economic condition of
                            target client.
                        </p>
                    </div>
                </div>
                <div class="VisionContainer">
                    <div class="circleContainer">
                        <div class="circle"></div>
                    </div>
                    <div class="VisionContent">
                        <h1>Vision</h1>
                        <p>
                            Indigent and Vulnerable Individuals, Families and Community in the
                            Municipality of Sogod, Southern Leyte become Self-reliant,
                            Empowered and Economically Stable, through the Implementation of
                            Comprehensive and Coordinated Social Welfare Program and Services
                            as Support for their Development.
                        </p>
                    </div>
                </div>
                <div class="GoalContainer">
                    <div class="circleContainer">
                        <div class="circle"></div>
                    </div>
                    <div class="GoalContent">
                        <h1>Goal</h1>
                        <p>
                            To deliver effectively and effeciently the development program and
                            services among less priveleged sectoral group such as Children,
                            Youth, Families, Women PWD, Senior Citizens and Walk-in clientele
                            for their welfare and safety
                        </p>
                    </div>
                </div>
                <div class="line"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </div>

        <footer>
            <div class="footerlogoMSWD"></div>
            <div class="footerContact">
                <h1>Contact Us</h1>
                <p>Sogod Municipal Hall, Southern Leyte, Philippines</p>
                <p>+63 XXX-XXX-XXXX</p>
                <div class="SocialMediaContainer">
                    <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://x.com/"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>

            <div class="footerCreator">
                <p>Joshua Catigan</p>
                <p>Jhoedhen Salera</p>
                <p>Dhanica Leyes</p>
                <p>Uriel Ann Jabay</p>
                <p>Leandro Dave</p>
            </div>
        </footer>
    </body>
    <!-- Boostrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{asset('js/script.js')}}"></script>

</html>