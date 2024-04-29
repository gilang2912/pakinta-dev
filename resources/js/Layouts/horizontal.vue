<script>
import { Link } from '@inertiajs/vue3'
import NavBar from '@/Components/nav-bar.vue'
import RightBar from '@/Components/right-bar.vue'
import Footer from '@/Components/footer.vue'
import Logo from '@/Components/Logo.vue'

export default {
    mounted() {
        this.initActiveMenu()
    },
    methods: {
        initActiveMenu(ele) {
            setTimeout(() => {
                var currentPath = window.location.pathname
                if (document.querySelector('#navbar-nav')) {
                    let a = document
                        .querySelector('#navbar-nav')
                        .querySelector('[href="' + currentPath + '"]')

                    if (a) {
                        a.classList.add('active')
                        let parentCollapseDiv = a.closest(
                            '.collapse.menu-dropdown'
                        )
                        if (parentCollapseDiv) {
                            parentCollapseDiv.classList.add('show')
                            parentCollapseDiv.parentElement.children[0].classList.add(
                                'active'
                            )
                            parentCollapseDiv.parentElement.children[0].setAttribute(
                                'aria-expanded',
                                'true'
                            )
                            if (
                                parentCollapseDiv.parentElement.closest(
                                    '.collapse.menu-dropdown'
                                )
                            ) {
                                parentCollapseDiv.parentElement
                                    .closest('.collapse')
                                    .classList.add('show')
                                if (
                                    parentCollapseDiv.parentElement.closest(
                                        '.collapse'
                                    ).previousElementSibling
                                )
                                    parentCollapseDiv.parentElement
                                        .closest('.collapse')
                                        .previousElementSibling.classList.add(
                                            'active'
                                        )
                            }
                        }
                    }
                }
            }, 1000)
        }
    },
    components: {
        NavBar,
        RightBar,
        Footer,
        Link,
        Logo
    }
}
</script>

<template>
    <div>
        <div id="layout-wrapper">
            <NavBar />
            <!-- ========== App Menu ========== -->
            <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <!-- Dark Logo-->
                    <Link href="/" class="logo logo-dark">
                        <span class="logo-sm">
                            <Logo />
                        </span>
                        <span class="logo-lg">
                            <Logo />
                        </span>
                    </Link>
                    <!-- Light Logo-->
                    <Link href="/" class="logo logo-light">
                        <span class="logo-sm">
                            <Logo />
                        </span>
                        <span class="logo-lg">
                            <Logo />
                        </span>
                    </Link>
                    <button
                        type="button"
                        class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                        id="vertical-hover"
                    >
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>
                <div id="scrollbar">
                    <BContainer fluid>
                        <ul class="navbar-nav h-100" id="navbar-nav">
                            <li class="menu-title">
                                <span data-key="t-menu">Menu</span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="/">
                                    <i class="ri-dashboard-2-line"></i>
                                    <span data-key="t-dashboards">
                                        Dashboard
                                    </span>
                                </a>
                            </li>
                            <!-- end Dashboard Menu -->
                        </ul>
                    </BContainer>
                    <!-- Sidebar -->
                </div>
                <!-- Left Sidebar End -->
                <!-- Vertical Overlay-->
                <div class="vertical-overlay"></div>
            </div>
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="main-content">
                <div class="page-content">
                    <!-- Start Content-->
                    <BContainer fluid>
                        <slot />
                    </BContainer>
                </div>
                <Footer />
            </div>
            <RightBar />
        </div>
    </div>
</template>
