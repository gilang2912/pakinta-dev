<script setup>
import { layoutMethods } from '@/state/helpers'
import { Link, router } from '@inertiajs/vue3'
</script>

<script>
import { Link } from '@inertiajs/vue3'
import simplebar from 'simplebar-vue'
import Logo from './Logo.vue'

/**
 * Nav-bar Component
 */
export default {
    data() {
        return {}
    },
    components: {
        simplebar,
        Link,
        Logo
    },
    methods: {
        ...layoutMethods,
        isCustomDropdown() {
            //Search bar
            var searchOptions = document.getElementById('search-close-options')
            var dropdown = document.getElementById('search-dropdown')
            var searchInput = document.getElementById('search-options')

            searchInput.addEventListener('focus', () => {
                var inputLength = searchInput.value.length
                if (inputLength > 0) {
                    dropdown.classList.add('show')
                    searchOptions.classList.remove('d-none')
                } else {
                    dropdown.classList.remove('show')
                    searchOptions.classList.add('d-none')
                }
            })

            searchInput.addEventListener('keyup', () => {
                var inputLength = searchInput.value.length
                if (inputLength > 0) {
                    dropdown.classList.add('show')
                    searchOptions.classList.remove('d-none')
                } else {
                    dropdown.classList.remove('show')
                    searchOptions.classList.add('d-none')
                }
            })

            searchOptions.addEventListener('click', () => {
                searchInput.value = ''
                dropdown.classList.remove('show')
                searchOptions.classList.add('d-none')
            })

            document.body.addEventListener('click', e => {
                if (e.target.getAttribute('id') !== 'search-options') {
                    dropdown.classList.remove('show')
                    searchOptions.classList.add('d-none')
                }
            })
        },
        toggleHamburgerMenu() {
            var windowSize = document.documentElement.clientWidth
            let layoutType =
                document.documentElement.getAttribute('data-layout')

            document.documentElement.setAttribute(
                'data-sidebar-visibility',
                'show'
            )
            let visiblilityType = document.documentElement.getAttribute(
                'data-sidebar-visibility'
            )

            if (windowSize > 767)
                document
                    .querySelector('.hamburger-icon')
                    .classList.toggle('open')

            //For collapse horizontal menu
            if (
                document.documentElement.getAttribute('data-layout') ===
                'horizontal'
            ) {
                document.body.classList.contains('menu')
                    ? document.body.classList.remove('menu')
                    : document.body.classList.add('menu')
            }

            //For collapse vertical menu
            if (
                visiblilityType === 'show' &&
                (layoutType === 'vertical' || layoutType === 'semibox')
            ) {
                if (windowSize < 1025 && windowSize > 767) {
                    document.body.classList.remove('vertical-sidebar-enable')
                    document.documentElement.getAttribute(
                        'data-sidebar-size'
                    ) == 'sm'
                        ? document.documentElement.setAttribute(
                              'data-sidebar-size',
                              ''
                          )
                        : document.documentElement.setAttribute(
                              'data-sidebar-size',
                              'sm'
                          )
                } else if (windowSize > 1025) {
                    document.body.classList.remove('vertical-sidebar-enable')
                    document.documentElement.getAttribute(
                        'data-sidebar-size'
                    ) == 'lg'
                        ? document.documentElement.setAttribute(
                              'data-sidebar-size',
                              'sm'
                          )
                        : document.documentElement.setAttribute(
                              'data-sidebar-size',
                              'lg'
                          )
                } else if (windowSize <= 767) {
                    document.body.classList.add('vertical-sidebar-enable')
                    document.documentElement.setAttribute(
                        'data-sidebar-size',
                        'lg'
                    )
                }
            }

            //Two column menu
            if (
                document.documentElement.getAttribute('data-layout') ==
                'twocolumn'
            ) {
                document.body.classList.contains('twocolumn-panel')
                    ? document.body.classList.remove('twocolumn-panel')
                    : document.body.classList.add('twocolumn-panel')
            }
        },
        toggleMenu() {
            this.$parent.toggleMenu()
        },
        toggleRightSidebar() {
            this.$parent.toggleRightSidebar()
        },
        initFullScreen() {
            document.body.classList.toggle('fullscreen-enable')
            if (
                !document.fullscreenElement &&
                /* alternative standard method */
                !document.mozFullScreenElement &&
                !document.webkitFullscreenElement
            ) {
                // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen()
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen()
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(
                        Element.ALLOW_KEYBOARD_INPUT
                    )
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen()
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen()
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen()
                }
            }
        },
        toggleDarkMode() {
            if (
                document.documentElement.getAttribute('data-bs-theme') == 'dark'
            ) {
                document.documentElement.setAttribute('data-bs-theme', 'light')
            } else {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            }

            const mode = document.documentElement.getAttribute('data-bs-theme')
            this.changeMode({
                mode: mode
            })
        }
    },
    mounted() {
        document.addEventListener('scroll', function () {
            var pageTopbar = document.getElementById('page-topbar')
            if (pageTopbar) {
                document.body.scrollTop >= 50 ||
                document.documentElement.scrollTop >= 50
                    ? pageTopbar.classList.add('topbar-shadow')
                    : pageTopbar.classList.remove('topbar-shadow')
            }
        })
        if (document.getElementById('topnav-hamburger-icon'))
            document
                .getElementById('topnav-hamburger-icon')
                .addEventListener('click', this.toggleHamburgerMenu)

        this.isCustomDropdown()
    }
}
</script>

<template>
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <Link href="/" class="logo logo-dark">
                            <span class="logo-sm">
                                <logo />
                            </span>
                            <span class="logo-lg">
                                <Logo />
                            </span>
                        </Link>

                        <Link href="/" class="logo logo-light">
                            <span class="logo-sm">
                                <logo />
                            </span>
                            <span class="logo-lg">
                                <Logo />
                            </span>
                        </Link>
                    </div>

                    <button
                        type="button"
                        class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                        id="topnav-hamburger-icon"
                    >
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-md-block">
                        <div class="position-relative">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search..."
                                autocomplete="off"
                                id="search-options"
                                value=""
                            />
                            <span
                                class="mdi mdi-magnify search-widget-icon"
                            ></span>
                            <span
                                class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                id="search-close-options"
                            ></span>
                        </div>
                        <div
                            class="dropdown-menu dropdown-menu-lg"
                            id="search-dropdown"
                        >
                            <simplebar data-simplebar style="max-height: 320px">
                                <div class="dropdown-header">
                                    <h6
                                        class="text-overflow text-muted mb-0 text-uppercase"
                                    >
                                        Recent Searches
                                    </h6>
                                </div>

                                <div
                                    class="dropdown-item bg-transparent text-wrap"
                                >
                                    <Link
                                        href="/"
                                        class="btn btn-soft-secondary btn-sm rounded-pill"
                                        >how to setup
                                        <i class="mdi mdi-magnify ms-1"></i
                                    ></Link>
                                    <Link
                                        href="/"
                                        class="btn btn-soft-secondary btn-sm rounded-pill"
                                        >buttons
                                        <i class="mdi mdi-magnify ms-1"></i
                                    ></Link>
                                </div>
                                <div class="dropdown-header mt-2">
                                    <h6
                                        class="text-overflow text-muted mb-1 text-uppercase"
                                    >
                                        Pages
                                    </h6>
                                </div>

                                <BLink
                                    href="javascript:void(0);"
                                    class="dropdown-item notify-item"
                                >
                                    <i
                                        class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"
                                    ></i>
                                    <span>Analytics Dashboard</span>
                                </BLink>

                                <BLink
                                    href="javascript:void(0);"
                                    class="dropdown-item notify-item"
                                >
                                    <i
                                        class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"
                                    ></i>
                                    <span>Help Center</span>
                                </BLink>

                                <BLink
                                    href="javascript:void(0);"
                                    class="dropdown-item notify-item"
                                >
                                    <i
                                        class="ri-user-settings-line align-middle fs-18 text-muted me-2"
                                    ></i>
                                    <span>My account settings</span>
                                </BLink>

                                <div class="dropdown-header mt-2">
                                    <h6
                                        class="text-overflow text-muted mb-2 text-uppercase"
                                    >
                                        Members
                                    </h6>
                                </div>

                                <div class="notification-list">
                                    <BLink
                                        href="javascript:void(0);"
                                        class="d-flex dropdown-item notify-item py-2"
                                    >
                                        <img
                                            src="@assets/images/users/avatar-2.jpg"
                                            class="me-3 rounded-circle avatar-xs"
                                            alt="user-pic"
                                        />
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Angela Bernier</h6>
                                            <span class="fs-11 mb-0 text-muted"
                                                >Manager</span
                                            >
                                        </div>
                                    </BLink>
                                    <BLink
                                        href="javascript:void(0);"
                                        class="d-flex dropdown-item notify-item py-2"
                                    >
                                        <img
                                            src="@assets/images/users/avatar-3.jpg"
                                            class="me-3 rounded-circle avatar-xs"
                                            alt="user-pic"
                                        />
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">David Grasso</h6>
                                            <span class="fs-11 mb-0 text-muted"
                                                >Web Designer</span
                                            >
                                        </div>
                                    </BLink>
                                    <BLink
                                        href="javascript:void(0);"
                                        class="d-flex dropdown-item notify-item py-2"
                                    >
                                        <img
                                            src="@assets/images/users/avatar-5.jpg"
                                            class="me-3 rounded-circle avatar-xs"
                                            alt="user-pic"
                                        />
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Mike Bunch</h6>
                                            <span class="fs-11 mb-0 text-muted"
                                                >React Developer</span
                                            >
                                        </div>
                                    </BLink>
                                </div>
                            </simplebar>

                            <div class="text-center pt-3 pb-1">
                                <Link
                                    href="/pages/search-results"
                                    class="btn btn-primary btn-sm"
                                    >View All Results
                                    <i class="ri-arrow-right-line ms-1"></i
                                ></Link>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="d-flex align-items-center">
                    <div class="ms-1 header-item d-none d-sm-flex">
                        <BButton
                            type="button"
                            variant="ghost-secondary"
                            class="btn-icon btn-topbar rounded-circle"
                            data-toggle="fullscreen"
                            @click="initFullScreen"
                        >
                            <i class="bx bx-fullscreen fs-22"></i>
                        </BButton>
                    </div>

                    <div class="ms-1 header-item d-none d-sm-flex">
                        <BButton
                            type="button"
                            variant="ghost-secondary"
                            class="btn-icon btn-topbar rounded-circle light-dark-mode"
                            @click="toggleDarkMode"
                        >
                            <i class="bx bx-moon fs-22"></i>
                        </BButton>
                    </div>

                    <BDropdown
                        variant="link"
                        class="ms-sm-3 header-item topbar-user"
                        toggle-class="rounded-circle arrow-none"
                        menu-class="dropdown-menu-end"
                        :offset="{
                            alignmentAxis: -14,
                            crossAxis: 0,
                            mainAxis: 0
                        }"
                    >
                        <template #button-content>
                            <span class="d-flex align-items-center">
                                <img
                                    class="rounded-circle header-profile-user"
                                    src="@assets/images/users/user-dummy-img.jpg"
                                    alt="username"
                                />
                                <span class="text-start ms-xl-2">
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-semibold user-name-text"
                                        >Username</span
                                    >
                                    <span
                                        class="d-none d-xl-block ms-1 fs-13 user-name-sub-text"
                                        >Founder</span
                                    >
                                </span>
                            </span>
                        </template>
                        <h6 class="dropdown-header">Welcome !</h6>
                        <Link class="dropdown-item" href="#"
                            ><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"
                            ></i>
                            <span class="align-middle">Profile</span>
                        </Link>
                        <div class="dropdown-divider"></div>
                        <Link class="dropdown-item" href="/chat">
                            <i
                                class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"
                            ></i>
                            <span class="align-middle"> Messages</span>
                        </Link>
                        <Link class="dropdown-item" href="/apps/tasks-kanban">
                            <i
                                class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"
                            ></i>
                            <span class="align-middle"> Taskboard</span>
                        </Link>
                        <Link class="dropdown-item" href="/pages/faqs"
                            ><i
                                class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"
                            ></i>
                            <span class="align-middle"> Help</span>
                        </Link>
                        <div class="dropdown-divider"></div>
                        <Link class="dropdown-item" href="/pages/profile"
                            ><i
                                class="mdi mdi-wallet text-muted fs-16 align-middle me-1"
                            ></i>
                            <span class="align-middle">
                                Balance : <b>$5971.67</b></span
                            >
                        </Link>
                        <Link
                            class="dropdown-item"
                            href="/pages/profile-setting"
                        >
                            <BBadge
                                variant="success-subtle"
                                class="bg-success-subtle text-success mt-1 float-end"
                                >New</BBadge
                            ><i
                                class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"
                            ></i>
                            <span class="align-middle"> Settings</span>
                        </Link>
                        <Link
                            class="dropdown-item"
                            href="/auth/lockscreen-basic"
                            ><i
                                class="mdi mdi-lock text-muted fs-16 align-middle me-1"
                            ></i>
                            <span class="align-middle"> Lock screen</span>
                        </Link>

                        <!-- Authentication -->
                        <form method="POST" class="dropdown-item">
                            <BButton
                                variant="none"
                                type="submit"
                                class="btn p-0"
                                ><i
                                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"
                                ></i>
                                Logout</BButton
                            >
                        </form>
                    </BDropdown>
                </div>
            </div>
        </div>
    </header>
</template>
