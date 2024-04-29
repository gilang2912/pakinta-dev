<script>
import { Link, router } from '@inertiajs/vue3'
import { layoutComputed } from '@/state/helpers'
import simplebar from 'simplebar-vue'

export default {
    components: {
        simplebar,
        Link
    },
    data() {
        return {
            settings: {
                minScrollbarLength: 60
            }
        }
    },
    computed: {
        ...layoutComputed,
        layoutType: {
            get() {
                return this.$store
                    ? this.$store.state.layout.layoutType
                    : {} || {}
            }
        }
    },
    mounted() {
        this.initActiveMenu()
        this.onRoutechange()
        if (document.querySelectorAll('.navbar-nav .collapse')) {
            let collapses = document.querySelectorAll('.navbar-nav .collapse')

            collapses.forEach(collapse => {
                // Hide sibling collapses on `show.bs.collapse`
                collapse.addEventListener('show.bs.collapse', e => {
                    e.stopPropagation()
                    let closestCollapse =
                        collapse.parentElement.closest('.collapse')
                    if (closestCollapse) {
                        let siblingCollapses =
                            closestCollapse.querySelectorAll('.collapse')
                        siblingCollapses.forEach(siblingCollapse => {
                            if (siblingCollapse.classList.contains('show')) {
                                siblingCollapse.classList.remove('show')
                                siblingCollapse.parentElement.firstChild.setAttribute(
                                    'aria-expanded',
                                    'false'
                                )
                            }
                        })
                    } else {
                        let getSiblings = elem => {
                            // Setup siblings array and get the first sibling
                            let siblings = []
                            let sibling = elem.parentNode.firstChild
                            // Loop through each sibling and push to the array
                            while (sibling) {
                                if (
                                    sibling.nodeType === 1 &&
                                    sibling !== elem
                                ) {
                                    siblings.push(sibling)
                                }
                                sibling = sibling.nextSibling
                            }
                            return siblings
                        }
                        let siblings = getSiblings(collapse.parentElement)
                        siblings.forEach(item => {
                            if (item.childNodes.length > 2) {
                                item.firstElementChild.setAttribute(
                                    'aria-expanded',
                                    'false'
                                )
                                item.firstElementChild.classList.remove(
                                    'active'
                                )
                            }
                            let ids = item.querySelectorAll('*[id]')
                            ids.forEach(item1 => {
                                item1.classList.remove('show')
                                item1.parentElement.firstChild.setAttribute(
                                    'aria-expanded',
                                    'false'
                                )
                                item1.parentElement.firstChild.classList.remove(
                                    'active'
                                )
                                if (item1.childNodes.length > 2) {
                                    let val = item1.querySelectorAll('ul li a')

                                    val.forEach(subitem => {
                                        if (
                                            subitem.hasAttribute(
                                                'aria-expanded'
                                            )
                                        )
                                            subitem.setAttribute(
                                                'aria-expanded',
                                                'false'
                                            )
                                    })
                                }
                            })
                        })
                    }
                })

                // Hide nested collapses on `hide.bs.collapse`
                collapse.addEventListener('hide.bs.collapse', e => {
                    e.stopPropagation()
                    let childCollapses = collapse.querySelectorAll('.collapse')
                    childCollapses.forEach(childCollapse => {
                        let childCollapseInstance = childCollapse
                        childCollapseInstance.classList.remove('show')
                        childCollapseInstance.parentElement.firstChild.setAttribute(
                            'aria-expanded',
                            'false'
                        )
                    })
                })
            })
        }
    },

    methods: {
        onRoutechange() {
            // this.initActiveMenu();
            setTimeout(() => {
                var currentPath = window.location.pathname
                if (document.querySelector('#navbar-nav')) {
                    let currentPosition = document
                        .querySelector('#navbar-nav')
                        .querySelector(
                            '[href="' + currentPath + '"]'
                        )?.offsetTop
                    if (
                        currentPosition > document.documentElement.clientHeight
                    ) {
                        document.querySelector(
                            '#scrollbar .simplebar-content-wrapper'
                        )
                            ? (document.querySelector(
                                  '#scrollbar .simplebar-content-wrapper'
                              ).scrollTop =
                                  currentPosition +
                                  document.documentElement.clientHeight / 2)
                            : ''
                    }
                }
            }, 500)
        },

        initActiveMenu() {
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
                                const grandparent =
                                    parentCollapseDiv.parentElement
                                        .closest('.collapse')
                                        .previousElementSibling.parentElement.closest(
                                            '.collapse'
                                        )
                                if (
                                    grandparent &&
                                    grandparent &&
                                    grandparent.previousElementSibling
                                ) {
                                    grandparent.previousElementSibling.classList.add(
                                        'active'
                                    )
                                    grandparent.classList.add('show')
                                }
                            }
                        }
                    }
                }
            }, 0)
        }
    }
}
</script>

<template>
    <BContainer fluid>
        <div id="two-column-menu"></div>

        <template v-if="layoutType === 'vertical' || layoutType === 'semibox'">
            <ul class="navbar-nav h-100" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu">MENU</span>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" href="/">
                        <i class="ri-dashboard-2-line"></i>
                        <span>Dashboard</span>
                    </Link>
                </li>
                <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a
                        class="nav-link menu-link"
                        href="#aplikasi"
                        data-bs-toggle="collapse"
                        role="button"
                        aria-expanded="false"
                        aria-controls="aplikasi"
                    >
                        <i class="ri-apps-2-line"></i>
                        <span data-key="t-apps">Aplikasi</span>
                    </a>
                    <div class="collapse menu-dropdown" id="aplikasi">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <Link href="#" class="nav-link">
                                    Managemen Pengguna
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link menu-link"
                        href="#sidebarRegis"
                        data-bs-toggle="collapse"
                        role="button"
                        aria-expanded="false"
                        aria-controls="sidebarRegis"
                    >
                        <i class="ri-file-list-3-line"></i>
                        <span data-key="t-forms">Pendaftaran</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRegis">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <Link href="#" class="nav-link">
                                    Pendaftaran Baru
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link menu-link"
                        href="#sidebarPendataan"
                        data-bs-toggle="collapse"
                        role="button"
                        aria-expanded="false"
                        aria-controls="sidebarPendataan"
                    >
                        <i class="ri-pages-line"></i>
                        <span data-key="t-forms">Pendataan</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPendataan">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="#sidebarSelf"
                                    data-bs-toggle="collapse"
                                    role="button"
                                    aria-expanded="false"
                                    aria-controls="sidebarSelf"
                                >
                                    Self Assesement
                                </a>
                                <div
                                    class="collapse menu-dropdown"
                                    id="sidebarSelf"
                                >
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a
                                                class="nav-link"
                                                href="#sidebarPbjt"
                                                data-bs-toggle="collapse"
                                                role="button"
                                                aria-expanded="false"
                                                aria-controls="sidebarPbjt"
                                            >
                                                PBJT
                                            </a>
                                            <div
                                                class="collapse menu-dropdown"
                                                id="sidebarPbjt"
                                            >
                                                <ul
                                                    class="nav nav-sm flex-column"
                                                >
                                                    <li class="nav-item">
                                                        <Link
                                                            class="nav-link"
                                                            href="#"
                                                        >
                                                            PBJT Makanan dan
                                                            Minuman
                                                        </Link>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </template>
    </BContainer>
</template>
