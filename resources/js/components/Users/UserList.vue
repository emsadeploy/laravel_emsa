<template>
    <div>
        <encabezado titulo="" seccion_principal="Usuarios" seccion_secundaria="Lista"></encabezado>

        <div class="table-responsive card">
            <h5 class="card-header bg-transparent border-bottom text-uppercase">Listado de Usuarios 
                <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario" @click="showModalCreate()">
                    Crear Usuario <i class="bx bx-plus-circle font-size-16 align-middle "></i>
                </button>
            </h5>
           <div class="card-body">
             <table class="table table-striped-columns table-hover table-sm  mt-2" v-if="users.length">
                <thead class="table-light">
                    <th class="text-center">Rut</th> <!-- como alinea los head-->
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellido Paterno </th>
                    <th class="text-center">Apellido Materno </th>
                    <th class="text-center">Teléfono </th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Gerencia </th>
                    <th class="text-center">Empresa </th>
                    <th class="text-center">Estado</th>
                    <th class="text-center" style="min-width: 170px;">Opciones</th>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.rut">
                        <td v-text="user.nr_rut"></td>
                        <td v-text="user.name"></td>
                        <td v-text="user.ap_paterno"></td>
                        <td v-text="user.ap_materno"></td>
                        <td>
                            <a :href="`https://wa.me/${user.nr_telefono}`" target="_blank" rel="noopener">
                                {{ user.nr_telefono }}
                            </a>
                        </td>
                        <td>
                            <a :href="`mailto:${user.email}`">
                                {{ user.email }}
                            </a>
                        </td>
                        <td >
                            <span v-if="user.gerency" v-text="user.gerency.name"></span>
                            <span v-else>SIN DEFINIR</span>
                        </td>
                        <td >
                            <span class="badge" :class="{'bg-primary': user.str_empresa === 'EMSA', 'bg-secondary': user.str_empresa == 'DILAT'}">
                                {{ user.str_empresa }}
                            </span>
                        </td>
                        <td>
                             <span class="badge" :class="{'bg-danger': user.is_active === 0, 'bg-success': user.is_active == 1}">
                                {{ user.is_active === 0 ? 'Desactivado' : 'Activo' }}
                            </span>
                        </td>
                        <td>
                            <button @click="showModalEdit(user)" type="button" class="btn btn-sm btn-info mx-1" data-bs-toggle="modal" data-bs-target="#modalEditUser">
                                <i class="bx bx-pencil font-size-16"></i>
                            </button>
                            <button v-if=" user.is_active ==1"  class="btn btn-sm btn-warning"><i class="bx bxs-user-x font-size-16"></i></button>
                            <button v-if="user.is_active == 0"  class="btn btn-sm btn-success"><i class="bx bxs-user-check font-size-16"></i></button>
                            <button  class="btn btn-sm btn-danger mx-1"> <i class="bx bxs-trash font-size-16"></i> </button>

                        </td>
                    </tr>
                </tbody>
            </table>
            <nav class="mt-3">
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                    </li>
                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                    </li>
                </ul>
            </nav>
           </div>
        </div>

        <!-- Modal Editar Usuario -->
        <div id="modalEditUser" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="myModalLabel">Editar Usuario</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateUser">

                            <!-- SECCIÓN 1: Datos Personales y de Contacto -->
                            <div class="mb-4">
                                <h6 class="text-primary">Datos Personales y de Contacto</h6>
                                <hr class="mt-1">
                                <div class="row gy-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Nombre *:</label>
                                            <input required v-model="new_user.name" type="text" class="form-control">
                                            <small v-if="new_errors.name">{{new_errors.name[0]}}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Apellido Paterno *:</label>
                                            <input required v-model="new_user.ap_paterno" type="text" class="form-control">
                                            <small v-if="new_errors.ap_paterno">{{new_errors.ap_paterno[0]}}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Apellido Materno *:</label>
                                            <input required v-model="new_user.ap_materno" type="text" class="form-control">
                                            <small v-if="new_errors.ap_materno">{{new_errors.ap_materno[0]}}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Rut* :</label>
                                            <input required v-model="new_user.nr_rut" type="text" class="form-control">
                                            <small v-if="new_errors.nr_rut">{{new_errors.nr_rut[0]}}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Email :</label>
                                            <input required v-model="new_user.email" type="email" class="form-control">
                                            <small v-if="new_errors.email">{{new_errors.email[0]}}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Teléfono :</label>
                                            <input required v-model="new_user.nr_telefono" type="text" class="form-control">
                                            <small v-if="new_errors.nr_telefono">{{new_errors.nr_telefono[0]}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SECCIÓN 2: Asignación y Roles -->
                            <div class="mb-4">
                                <h6 class="text-primary">Asignación y Roles</h6>
                                <hr class="mt-1">
                                <div class="row gy-4">
                                    <div v-if="gerencias.length" class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Gerencia :</label>
                                            <select v-model="new_user.id_gerencia" class="form-control">
                                                <option v-for="(item,index) in gerencias" :key="index" :value="item.id">{{ item.name }}</option>
                                            </select>
                                            <small v-if="new_errors.id_gerencia">{{new_errors.id_gerencia[0]}}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Roles :</label>
                                            <multiselect id="edit-user-roles"
                                                :multiple="true"
                                                v-model="new_user.roles" 
                                                :options="roles" 
                                                placeholder="Seleccione por lo menos un rol" 
                                                label="name"
                                                track-by="id">
                                            </multiselect>
                                            <small v-if="new_errors.rol">{{new_errors.rol[0]}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SECCIÓN 3: Credenciales de Seguridad -->
                            <div class="mb-2">
                                <h6 class="text-primary">Actualizar Contraseña (Opcional)</h6>
                                <hr class="mt-1">
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nueva Contraseña:</label>
                                            <input v-model="new_user.password" type="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
                                            <small v-if="new_errors.password">{{new_errors.password[0]}}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Confirmar Nueva Contraseña:</label>
                                            <input v-model="new_user.confirm_password" type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button @click="updateUser" type="button" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
        <!--  fin modal editar Usuario  -->

        <!-- Modal para Crear Usuario -->
        <div id="modalCrearUsuario" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" style="color:white">Crear Usuario</h5>
                    </div>
                    <div class="modal-body">

                        <!-- SECCIÓN 1: Datos Personales y de Contacto -->
                        <div class="mb-4">
                            <h6 class="text-primary">Datos Personales y de Contacto</h6>
                            <hr class="mt-1">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Nombre *:</label>
                                        <input required v-model="user.name" type="text" class="form-control">
                                        <small v-if="errors.name">{{errors.name[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Apellido Paterno *:</label>
                                        <input required v-model="user.ap_paterno" type="text" class="form-control">
                                        <small v-if="errors.ap_paterno">{{errors.ap_paterno[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Apellido Materno *:</label>
                                        <input required v-model="user.ap_materno" type="text" class="form-control">
                                        <small v-if="errors.ap_materno">{{errors.ap_materno[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Rut* :</label>
                                        <input required v-model="user.nr_rut" type="text" class="form-control">
                                        <small v-if="errors.nr_rut">{{errors.nr_rut[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Email :</label>
                                        <input required v-model="user.email" type="email" class="form-control">
                                        <small v-if="errors.email">{{errors.email[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Teléfono :</label>
                                        <input required v-model="user.nr_telefono" type="text" class="form-control">
                                        <small v-if="errors.nr_telefono">{{errors.nr_telefono[0]}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN 2: Asignación y Roles -->
                        <div class="mb-4">
                            <h6 class="text-primary">Asignación y Roles</h6>
                            <hr class="mt-1">
                            <div class="row gy-4">
                                <div v-if="gerencias.length" class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Gerencia :</label>
                                        <select v-model="user.id_gerencia" class="form-control">
                                            <option v-for="(item,index) in gerencias" :key="index" :value="item.id">{{ item.name }}</option>
                                        </select>
                                        <small v-if="errors.id_gerencia">{{errors.id_gerencia[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Roles :</label>
                                        <multiselect id="single-select-search"
                                            :multiple="true"
                                            v-model="user.roles" 
                                            :options="roles" 
                                            placeholder="Seleccione por lo menos un rol" 
                                            :close-on-select="false"
                                            label="name"
                                            track-by="id">
                                        </multiselect>
                                        <small v-if="errors.rol">{{errors.rol[0]}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN 3: Credenciales de Seguridad -->
                        <div class="mb-2">
                            <h6 class="text-primary">Credenciales de Seguridad</h6>
                            <hr class="mt-1">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Contraseña (4-8 caracteres) *:</label>
                                        <input required v-model="user.password" maxlength="8" type="password" class="form-control">
                                        <small v-if="errors.password">{{errors.password[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Confirmar Contraseña (4-8 caracteres) *:</label>
                                        <input required v-model="user.confirm_password" maxlength="8" type="password" class="form-control">
                                        <small v-if="errors.confirm_password">{{errors.confirm_password[0]}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                  
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button @click="insertUser" type="button" class="btn btn-success">Crear Usuario</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
import axios from 'axios';
import Multiselect from 'vue-multiselect'

import encabezado from '../partials/encabezado.vue';

export default {
    components: {
        'encabezado': encabezado,Multiselect
    },
    data() {
        return {
            users: [],
            offset                  : 3,
            new_errors              : [],
            errors                  : [],
            roles                   : [],
            gerencias               : [],
            pagination : {
                    'total'         : 0,
                    'current_page'  : 0,
                    'per_page'      : 0,
                    'last_page'     : 0,
                    'from'          : 0,
                    'to'            : 0,
                },
            new_user : {
                    'nombre'          : '',
                    'ap_paterno'    : '',
                    'ap_materno'    : '',
                    'email'         : '',
                    'nr_rut'        : '',
                    'password'      : '',
                    'roles'         : 1,
                    'id_gerencia'   : 0,
                    'roles'         : [],
                },
            user : {
                'name'                  : 'Juan ',
                'ap_paterno'            : 'Castillo',
                'ap_materno'            : 'Bravo',
                'email'                 : 'juan@ejemplo.com',
                'nr_rut'                : '18241152-3',
                'password'              : '12345678',
                'confirm_password'      : '12345678',
                'roles'                 : [],
                'id_gerencia'           : 0,
                'nr_telefono'           : '9456897482',
                'anexo'                 : ''
                },
        };
    },
    computed:
    {
        isActived: function()
        {
            return this.pagination.current_page;
        },
        pagesNumber: function() 
        { 
            if(!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if(from < 1) {
                from = 1;
            }

            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;

        }
    },
    methods: 
    {   init()
        {
            axios.get('/init')
            .then(response => 
            {
                let resp        = response.data;
                this.roles      = resp.roles;
                this.gerencias  = resp.gerencias;

                if(this.gerencias.length)
                {
                    this.user.id_gerencia = this.gerencias[0].id;
                    this.new_user.id_gerencia = this.gerencias[0].id;
                }
            })
        },
        showModalCreate()
        {
            this.new_user = {
                'nombre'          : '',
                'ap_paterno'    : '',
                'ap_materno'    : '',
                'email'         : '',
                'nr_rut'        : '',
                'password'      : '',
                'rol'           : 1,
                'id_gerencia'     : 0,
                'nr_telefono'   : '',
                'roles'         : [],
            }
            this.new_errors = [];
        },
        showModalEdit(user)
        {
            let me                      = this
            me.new_user                 = user
            console.log({'new_user': me.new_user})

        },
        insertUser()
        {
            let me = this;

            me.user.nr_telefono = parseInt(me.user.nr_telefono)
                
            axios.post('/user',me.user)
            .then(function(response)
            {
                let resp = response.data
                me.modalSweetAlert(resp)

                if(resp.error == 0)
                    me.user =  {
                                    'name'          : '',
                                    'apellido'    : '',
                                    'ap_materno'    : '',
                                    'email'         : '',
                                    'rut'           : '',
                                    'password'      : '',
                                    'nr_telefono'   : '',
                                    'rol'           : [],
                                }

                me.getUsers()
                
            })
            .catch(function(error)
            {
               

                if(error.response.status == 422)
                    me.errors = error.response.data.errors
                else
                    me.modalSweetAlert({title: 'Error', text: 'Error al crear usuario', icon: 'error', confirmButtonText: 'Aceptar'})
            })
        },
        updateUser()
        {
            let me = this;
            return

            axios.post('/user/update',me.new_user)
            .then(function(response)
            {
                let resp = response.data
                me.modalSweetAlert(resp)
                me.getUsers()
            })
            .catch(function(error){

                if(error.response.status == 422)
                    me.new_errors = error.response.data.errors
            })
        },
        cambiarPagina(page)
        {
            let me = this;
            me.pagination.current_page = page;
            me.getUsers(page);
        },
        getUsers(page=1)
        {
            let me = this;

            axios.get('/users',{params: { page: page }})
            .then(function(response)
            {
                var resp        = response.data;
                me.users        = resp.users.data;
                me.pagination   = resp.pagination;
            })
        },
    },
    name: 'App',
    mounted() {
        console.log('Vue component mounted successfully!');
        this.init()
        this.getUsers()

    }
};
</script>