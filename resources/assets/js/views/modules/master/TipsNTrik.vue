<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Tips N Trik Table
        </div>
        <div class="card-block">
          <button type="button" class="btn btn-primary" @click="primaryModal = true"><i class="fa fa-plus"></i>Tambah</button>
          <table class="table table-bordered table-striped table-condensed">
            <thead>
              <tr>
                <th>No</th>
                <th>File</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(task, index) in list">
                <td>{{ index + 1 }}</td>
                <td>{{ task.file }}</td>
                <td>{{ task.keterangan }}</td>
                <td>
                  <button type="button" class="btn btn-primary" @click="popUpEditMititi(task.id)"><i class="fa fa-edit"></i></button>
                  <button @click="deleteMititi(task.id)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
          <nav>
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Prev</a></li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div><!--/.col-->
    
    <modal title="Modal title" class="modal-primary" v-model="primaryModal" @ok="editMititi(dataForm.id)" effect="fade/zoom">
      <div slot="modal-header" class="modal-header">
        <h4 class="modal-title">Modal title</h4>
      </div>

        <div class="card-block">
          <div class="form-group">
            <label for="company">File</label>
            <input type="text" class="form-control" v-model="dataForm.file" value="{ dataForm.file }" placeholder="Masukan Nama File">
          </div>

          <div class="form-group">
            <label for="company">Keterangan</label>
            <input type="text" class="form-control" v-model="dataForm.keterangan" value="{ dataForm.keterangan }" placeholder="Masukan Keterangan">
          </div>

        </div>

    </modal>
  </div><!--/.row-->

</template>

<script>
  import modal from 'vue-strap/src/Modal'
    
    export default {
      name: 'modals',
      components: {
        modal
      },
      data() {
        return {
          primaryModal: false,
          list: [],
          dataForm: {},
          task: {
            id: '',
            file: '',
            keterangan: ''
          }
        };
      },
        
        created() {
          this.fetchMititiList();
        },
        
        methods: {
          fetchMititiList() {
            axios.get('api/mititi')
              .then((res) => {
                this.list = res.data.data;
              })
              .catch((err) => console.error(err));
            },
          
          createMititi() {
            axios.post('api/mititi', this.task)
              .then((res) => {
                this.task.body = '';
                this.fetchMititiList();
              })
              .catch((err) => console.error(err));
            },
            
            popUpEditMititi(id){
              axios.get('api/mititi/' + id)
                .then((res) => {
                  this.primaryModal = true;
                  this.dataForm = res.data;
                  debugger;
                })
                .catch((err) => console.error(err));
            },

            editMititi(id) {
              if(id && id !== ""){
                 axios.put('api/mititi/' + id, this.dataForm)
                .then((res) => {
                  this.primaryModal = false;
                  this.dataForm = {};
                  this.fetchMititiList()
                })
                .catch((err) => console.error(err));
              } else {
                axios.post('api/mititi', this.dataForm)
                .then((res) => {
                  this.primaryModal = false;
                  this.dataForm = {};
                  this.fetchMititiList()
                })
              .catch((err) => console.error(err));
              }
            },

            deleteMititi(id) {
              axios.delete('api/mititi/' + id)
                .then((res) => {
                  this.fetchMititiList()
                })
                .catch((err) => console.error(err));
            },
        }
    }
</script>
</script>