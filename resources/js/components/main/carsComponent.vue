<template>
    <div class="row">

        <div class="col-sm-6 col-lg-4" v-for="(car, index) in cars" :key="index">
            <div class="card border-0 my-3">
                <div class="card-body">
                    <img :src="car.image" class="img-fluid img-responsive" style="width: 100%; object-fit: contain; height: 200px" alt="">
                    <div class="row mt-2">
                        <h5 class="font-weight-bold text-sm mx-auto">{{ car.model }}
                        </h5>
                    </div>
                    <div class="container-fluid mt-4">
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <span class="font-weight-bold" style="font-size:15px">{{ car.description }}</span>
                            </div>
                            <div class="col-sm-6 text-center">
                                <span class="font-weight-bold text-sm" style="font-size:15px">ECMR</span>
                            </div>
                        </div>
                        <div class="row text-xs-center">
                            <div class="col-6">
                                <img src="/img/air-conditioner.png" alt="">
                                <span class="text-black-50 text-sm" v-if="car.AC === true">A/C</span>
                                <span class="text-black-50 text-sm" v-else>NO</span>
                            </div>
                            <div class="col-6 text-center">
                                <i class="fas fa-suitcase text-black-50"></i>
                                <span class="text-black-50 text-sm">{{ car.luggage }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <img class="img-responsive" src="/img/manual-transmission.png" alt="">
                                <span class="text-black-50 text-sm">{{ car.transmission }}</span>

                            </div>
                            <div class="col-6 text-center">
                                <i class="far fa-user text-black-50"></i>
                                <span class="text-black-50 text-sm">{{ car.passagers }}</span>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <h5 class="mx-auto badge badge-success" style="font-size:18px">{{ car.price }}</h5>
                        </div>
                        <div class="row mt-2">
                            <button class="btn btn-primary mx-auto btn-sm" style="border-radius: 5px">
                                <span class="font-weight-bold" @click="addToCart(car,index)">RESERVAR AUTO</span></button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="fixed-bottom mx-sm-3 mx-md-5 my-sm-3 my-md-5">
            <button @click="openModal" type="button" class="btn btn-primary rounded-circle p-3 ml-md-auto" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-shopping-cart"></i>
            </button>
        </div>
        <shopping-cart v-if="modal" :cart="cart"></shopping-cart>
    </div>

</template>

<script>
export default {
    name: "carsComponent",
    props: {
        cars: Array
    },
    data(){
        return {
            cart: [],
            modal: false
        }
    },
    methods: {
        addToCart(car){
            let find = this.cart.find(element => element === car);
            if(find){
                find.quantity += 1;
                toastr.success('Agregaste 1 pieza adicional');
            } else {
                this.cart.push(car);
                toastr.success('Agregado al carrito');
            }
        },
        openModal(){
            this.modal = true;
        }

    }



}
</script>

<style scoped>

</style>
