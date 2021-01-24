<?=
"
<template>
    <div class=\"container-fluid mt--6\">
        <div class=\"row\">
            <div class=\"col-xl-12 order-xl-1\">
                <div class=\"card\">
                    <div class=\"card-header\">
                        <div class=\"row align-items-center\">
                            <div class=\"col-8\">
                                <h3 class=\"mb-0\">Kertas Pertuduhan View</h3>
                            </div>
                            <!-- <div class=\"col-4 text-right\">
                  <a href=\"#!\" class=\"btn btn-sm btn-primary\">Settings</a>
                </div> -->
                        </div>
                    </div>
                    <div class=\"card-body\">
                        <form>
                            <h6 class=\"heading-small text-muted mb-4\">Maklumat Asas Pertuduhan</h6>
                            <div class=\"pl-lg-4\">
                                <div class=\"row\">
                                    <div class=\"col-lg-6\">
                                        <div class=\"form-group\">
                                            <label class=\"form-control-label\" for=\"input-id-jabatan\">ID Jabatan</label>
                                            <input type=\"text\" id=\"input-id-jabatan\" class=\"form-control\"
                                                placeholder=\"ID Jabatan\">
                                        </div>
                                    </div>
                                    <div class=\"col-lg-6\">
                                        <div class=\"form-group\">
                                            <label class=\"form-control-label\" for=\"input-no-kompaun\">No Kompaun</label>
                                            <input type=\"email\" id=\"input-no-kompaun\" class=\"form-control\"
                                                placeholder=\"No Kompaun\">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr class=\"my-4\" />
                            <!-- Address -->
                            <h6 class=\"heading-small text-muted mb-4\">Maklumat Lokasi Pertuduhan</h6>
                            <div class=\"pl-lg-4\">
                                <div class=\"row\">
                                    <div class=\"col-lg-6\">
                                        <div class=\"form-group\">
                                            <label class=\"form-control-label\" for=\"input-daerah\">Daerah</label>
                                            <input type=\"text\" id=\"input-daerah\" class=\"form-control\"
                                                placeholder=\"Daerah\">
                                        </div>
                                    </div>
                                    <div class=\"col-lg-6\">
                                        <div class=\"form-group\">
                                            <label class=\"form-control-label\" for=\"input-bahagian-mukim\">Bahagian /
                                                Mukim</label>
                                            <input type=\"text\" id=\"input-bahagian-mukim\" class=\"form-control\"
                                                placeholder=\"Bahagian / Mukim\">
                                        </div>
                                    </div>
                                </div>
                                <div class=\"row\">
                                    <div class=\"col-md-12\">
                                        <div class=\"form-group\">
                                            <label class=\"form-control-label\" for=\"input-alamat\">Alamat</label>
                                            <input id=\"input-alamat\" class=\"form-control\" placeholder=\"Alamat\"
                                                type=\"text\">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class=\"my-4\" />
                            <!-- Address -->
                            <h6 class=\"heading-small text-muted mb-4\">Maklumat Lain Pertuduhan</h6>
                            <div class=\"pl-lg-4\">
                                <div class=\"row\">
                                    <div class=\"col-lg-6\">
                                        <div class=\"form-group\">
                                            <label class=\"form-control-label\" for=\"input-kesalahan\">Kesalahan</label>
                                            <input type=\"text\" id=\"input-kesalahan\" class=\"form-control\"
                                                placeholder=\"Kesalahan\">
                                        </div>
                                    </div>
                                    <div class=\"col-lg-6\">
                                        <div class=\"form-group\">
                                            <label class=\"form-control-label\" for=\"input-tarikh-kesalahan\">Tarikh
                                                Kesalahan</label>
                                            <input type=\"text\" id=\"input-tarikh-kesalahan\" class=\"form-control\"
                                                placeholder=\"Tarikh Kesalahan\">
                                        </div>
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label class=\"form-control-label\">Catatan</label>
                                    <textarea rows=\"4\" class=\"form-control\" placeholder=\"Catatan\"></textarea>
                                </div>
                            </div>
                            <div class=\"col text-right\">
                                <!-- <router-link to=\"/charges\" class=\"btn btn-sm btn-primary\">Pertuduhan Baharu</router-link> -->
                                <button type=\"button\" @click=\"\$router.back()\" class=\"btn btn-primary\">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class=\"footer pt-0\">
            <div class=\"row align-items-center justify-content-lg-between\">
                <div class=\"col-lg-6\">
                    <div class=\"copyright text-center  text-lg-left  text-muted\">
                        &copy; 2020 <a href=\"https://www.creative-tim.com\" class=\"font-weight-bold ml-1\"
                            target=\"_blank\">Creative Tim</a>
                    </div>
                </div>
                <div class=\"col-lg-6\">
                    <ul class=\"nav nav-footer justify-content-center justify-content-lg-end\">
                        <li class=\"nav-item\">
                            <a href=\"https://www.creative-tim.com\" class=\"nav-link\" target=\"_blank\">Creative Tim</a>
                        </li>
                        <li class=\"nav-item\">
                            <a href=\"https://www.creative-tim.com/presentation\" class=\"nav-link\" target=\"_blank\">About
                                Us</a>
                        </li>
                        <li class=\"nav-item\">
                            <a href=\"http://blog.creative-tim.com\" class=\"nav-link\" target=\"_blank\">Blog</a>
                        </li>
                        <li class=\"nav-item\">
                            <a href=\"https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md\"
                                class=\"nav-link\" target=\"_blank\">MIT License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</template>

<script lang=\"ts\" src=\"./view.ts\"></script>
"
?>