<template>
    <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{ titulo }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ seccion_principal }}</a></li>
                            <li class="breadcrumb-item active">{{ seccion_secundaria }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
</template>
<script>
export default {
    name: 'Encabezado',
    props: {
        titulo: {
            type: String,
            default: 'Dashboard'
        },
        seccion_principal: {
            type: String,
            default: 'Dashboards'
        },
        seccion_secundaria: {
            type: String,
            default: 'Dashboard'
        }
    }
}
</script>