{{-- Load third party plugins in seperate file (node modules) --}}
<script type="text/javascript" src="{{ eventmie_asset('js/manifest.js') }}"></script>

{{-- localization --}}
<script type="text/javascript" src="{{ route('eventmie.eventmie_lang') }}"></script>


{{-- VueJs Global Constants --}}
<script type="text/javascript">
    const my_lang = {!! json_encode(session('my_lang', \Config::get('app.locale'))) !!};
    const timezone_conversion = {!! json_encode(!empty(setting('regional.timezone_conversion')) ? 1 : 0) !!};
    const timezone_default = {!! json_encode(setting('regional.timezone_default')) !!};


    const date_format = {
        vue_date_format: '{!! format_js_date() !!}',
        vue_time_format: '{!! format_js_time() !!}'
    };
</script>



{{-- Javascript Global Listener --}}
<script type="text/javascript">
    /**
     * Header menu onscroll 
     */
    var lastScrollTop = 0;

    function handleScroll() {
        let el = document.getElementById('navbar_vue');
        let st = window.pageYOffset || document.documentElement.scrollTop;

        lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
        if (window.scrollY > 1) {
            el.classList.add('shadow');
            el.classList.add('menu-fixed');
        } else {
            el.classList.remove('shadow');
            el.classList.remove('menu-fixed');

            if (el.classList.contains('is-active')) {
                el.classList.add('is-mobile');
            }
        }
    };

    function scrollListener(obj, type, fn) {
        if (obj.attachEvent) {
            obj['e' + type + fn] = fn;
            obj[type + fn] = function() {
                obj['e' + type + fn](window.event);
            };
            obj.attachEvent('on' + type, obj[type + fn]);
        } else {
            obj.addEventListener(type, fn, false);
        }
    }

    scrollListener(window, 'scroll', function(e) {
        handleScroll();
    });

    // dashboard  Toggle
    function clickToggle() {
        let dbWrapperTwo = document.getElementById("db-wrapper-two");
        let dbWrapper = document.getElementById("db-wrapper");
        sideToggle(dbWrapperTwo, dbWrapper);
    }

    //dashboard Toggle
    sideToggle = (dbWrapperTwo, dbWrapper) => {
        if (dbWrapper.classList == '' || dbWrapperTwo == '') {
            dbWrapperTwo.classList.add('toggled');
            dbWrapper.classList.add('toggled');
        } else {
            dbWrapperTwo.classList.remove('toggled');
            dbWrapper.classList.remove('toggled');
        }
    }

    // Copy to clipboard
    function copyToClipboard() {
        var dummy = document.createElement('input'),
            text = window.location.href;

        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);

        alert('Event URL Copied!')
    }


    // set local timezone 
    var local_timezone = {!! json_encode(route('eventmie.local_timezone')) !!};

    function setLocalTimezone() {
        // Making our request
        fetch(local_timezone, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    local_timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
                })
            })
            .then(Result => Result.json())
            .then(string => {
                console.log('lang', string);
            })
            .catch(errorMsg => {
                console.log(errorMsg);
            });
    }

    setLocalTimezone();

    // Bootstrap Navbar collapse using JS Script
    document.addEventListener("DOMContentLoaded", function() {
        const navbarToggler = document.querySelector(".navbar-toggler");
        const navbarCollapse = document.querySelector(".navbar-collapse");
        console.log(navbarToggler, navbarCollapse, 'navbar-collapse');
        if (navbarToggler || navbarCollapse) {
            navbarToggler.addEventListener("click", function() {
                // Toggle the visibility of the dropdown menu
                if (navbarCollapse.style.display === "none" || navbarCollapse.style.display === "") {
                    navbarCollapse.style.display = "block";
                    navbarCollapse.classList.add('show');
                } else {
                    navbarCollapse.style.display = "none";
                    navbarCollapse.classList.remove('show');
                }
            });

            // Close the dropdown if the user clicks outside of it
            document.addEventListener("click", function(event) {
                if (!navbarToggler.contains(event.target) && !navbarCollapse.contains(event.target)) {
                    navbarCollapse.style.display = "none";
                    navbarCollapse.classList.add('show');
                }
            });
        }
    });

    // Bootstrap Dropdown using JS Script
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownButtons = document.querySelectorAll(".dropdown-toggle");
        const dropdownMenus = document.querySelectorAll(".dropdown-menu");

        if (dropdownButtons || dropdownMenus) {
            // Add click event listeners to each dropdown button
            dropdownButtons.forEach((button, index) => {
                button.addEventListener("click", function() {
                    // Toggle the visibility of the corresponding dropdown menu
                    if (dropdownMenus[index].style.display === "none" || dropdownMenus[index]
                        .style
                        .display === "") {
                        dropdownMenus[index].style.display = "block";
                        dropdownMenus[index].style.border = "1px solid #fff";
                        dropdownMenus[index].classList.add('show', 'shadow');
                    } else {
                        dropdownMenus[index].style.display = "none";
                        dropdownMenus[index].classList.remove('show', 'shadow');
                    }
                });
            });

            // Close all dropdowns if the user clicks outside of any dropdown
            document.addEventListener("click", function(event) {
                dropdownButtons.forEach((button, index) => {
                    if (!button.contains(event.target) && !dropdownMenus[index].contains(event
                            .target)) {
                        dropdownMenus[index].style.display = "none";
                        dropdownMenus[index].style.border = "1px solid #fff";
                        dropdownMenus[index].classList.remove('show', 'shadow');
                    }
                });
            });
        }
    });
</script>
