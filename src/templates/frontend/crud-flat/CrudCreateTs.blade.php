<?=

"

import { Vue, setup } from \"vue-class-component\";
import Swal from 'sweetalert2';
import { departmentFactory, DepartmentBloc, Department } from \"@/modules/department\";
import { districtFactory, DistrictBloc, District } from \"@/services/bloc/index\";
import axios from \"axios\";
import env from \"@/config/environment\";

export default class CreateCharges extends Vue {
    departmentBloc: DepartmentBloc = setup(() => departmentFactory())
    districtBloc: DistrictBloc = setup(() => districtFactory())

    private departmentURL:string = `\${env.API_URL}/department`;
    private districtURL:string = `\${env.API_URL}/district`;
    private subDistrictURL:string = `\${env.API_URL}/subdistrict`;
    private offenceURL:string = `\${env.API_URL}/offence`;

    departments:any=  []
    districts:any=  []
    subDistrict:any = []
    offence:any = []

    created() {
        // this.departmentBloc.init(),
        // this.districtBloc.init(),

        axios.get(this.departmentURL).then(response => {
            if(response.data.success)
            this.departments = response.data.data.data
        })

        axios.get(this.districtURL).then(response => {
            if(response.data.success)
            this.districts = response.data
        })

        axios.get(this.subDistrictURL).then(response => {
            if(response.data.success)
            this.subDistrict = response.data
        })

        axios.get(this.offenceURL).then(response => {
            if(response.data.success)
            this.offence = response.data
        })
    }

    async mounted() {

        // create
        // this.departmentBloc.create({ id: 6, name: 'DIREKTORAT PENGUATKUASAAN' })

        // update
        // this.departmentBloc.update(2, { id: 2, name: 'ASD ASD' })

        // delete
        this.departmentBloc.destroy(1)
        this.districtBloc.destroy(1)
        await this.\$nextTick()
        // console.log('department', this.departmentBloc.departments)
    }

    submit(value: any) {
        Swal.fire({
            title: 'Are you sure?',
            text: \"You won't be able to revert this!\",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed it!'
        }).then(async(result) => {
            if (result.isConfirmed) {

                let response = await this.create();
                if (!response.data.success){
                    await Swal.fire({
                        icon: 'error',
                        title: response.data.message,
                        text: 'Error Occured',
                    });
                } else {
                    await Swal.fire(
                        'Good job!',
                        'You clicked the button!',
                        'success'
                      )
                    this.\$router.replace('/charges');
                }
            }
        })
    }

    async create() {
        const data:any  = {
            name : \"test\"
        }
        const response:any = {
            data : {
                \"success\":true,
                \"code\":200,
                \"message\":\"Succesfull Insert Data\"
            }
        }

        const article = data;
        // const response = await axios.post(\"https://e-dakwaan2.test/api/department\", article);
        return response;
    }




}

"
?>