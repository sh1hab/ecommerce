@extends('frontend.layouts.master')

@section('content')
    <main role="main">
        <div class="container">
            <div id="about">

                <tabs>
                    <tab name="about us" :selected="true">
                        <h2>ABOUT US</h2>
                    </tab>

                    <tab name="about our culture">
                        CONTACT US
                    </tab>

                    <tab name="us">
                        US
                    </tab>

                </tabs>

            </div>
        </div>

    </main>
@stop

@section('js')

    <script type="text/javascript">

        Vue.component('tab', {
            template:
                `
            <div class="tab ">
                <slot></slot>
            </div>
            `,
            props: {
                name: {required: true},

            }

        });

        Vue.component('tabs', {

            template:
                `
            <div>
                
                <div class="nav nav-tabs" id="nav-tab" role="tablist">   
                    // <ul class="nav nav-tabs">
                        <li class="nav-item" v-for="tab in tabs" 
                        :class="{ 'show':tab.selected }">
                            <a class="nav-link active" href="#" @click="">@{{ tab.name }}</a>
                        </li>
                        
                    // </ul>
                </div>

                

                <div class="tab-content" id="nav-tabContent">
                    <slot></slot>
                </div>
            </div>  
            `,

            data() {
                return {
                    tabs: []
                }
            },

            created() {
                this.tabs = this.$children;
                // console.log( this.$children );
            }

        });


        let about = new Vue({
            "el": '#about',
            "data": {},
            "methods": {},
            created() {
                // console.log( this.$children );
            }
        });

    </script>

@stop



