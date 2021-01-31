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
                                <h3 class=\"mb-0\">Kertas Pertuduhan Edit</h3>
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
                                <!-- <router-link to=\"/crud/departments\" class=\"btn btn-sm btn-primary\">Pertuduhan Baharu</router-link> -->
                                <button type=\"button\" @click=\"\$router.back()\" class=\"btn btn-primary\">Hantar</button>
                                <button type=\"button\" @click=\"\$router.back()\" class=\"btn btn-default\">Kembali</button>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang=\"ts\" src=\"./edit.ts\"></script>
"
?>