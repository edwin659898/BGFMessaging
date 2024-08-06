

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="department" value="Department" />
                <Multiselect v-model="form.department" :options="{
                    Communication:'Communication',
                    Finance_and_Accounts:' Finance and Accounts',
                    Forestry: 'Forestry',
                    IT: 'IT',
                    HR: 'HR',
                    Oparations: 'Oparations',
                    Monitoring_and_Evaluation:'Monitoring and Evaluation',
                    Senior_Management:'Senior Management',
                }" />
                <InputError class="mt-2" :message="form.errors.department" />
            </div>


            <div class="mt-4">
                <InputLabel for="site" value="Site" />
                <Multiselect v-model="form.site" :options="{
                    Head_Office: 'Head Office',
                    Dokolo: 'Dokolo',
                    Kiambere: 'Kiambere',
                    Nyongoro: 'Nyongoro'
                }" />
                <InputError class="mt-2" :message="form.errors.site" />
            </div>

            <div class="mt-4">
                <InputLabel for="gender" value="Gender" />
                <Multiselect v-model="form.gender" :options="{
                    Female: 'Female',
                    Male: 'Male',
                    Transgender: 'Transgender'
                }" />
                <InputError class="mt-2" :message="form.errors.gender" />
            </div>

            <div class="mt-4">
                <InputLabel for="marital_status" value="Marital status" />
                <Multiselect v-model="form.marital_status" :options="{
                    Complicated: 'Complicated',
                    Divorced: 'Divorced',
                    Married: 'Married',
                    Single: 'Single'
                }" />
                <InputError class="mt-2" :message="form.errors.marital_status" />
            </div>

            <div class="mt-4">
                <InputLabel for="date" value="Date of Birth" />

                <VueDatePicker v-model="form.date"></VueDatePicker>

                <InputError class="mt-2" :message="form.errors.date" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone_number" value="Phone Number" />
                    <MazPhoneNumberInput
                        v-model="form.phone_number"
                        show-code-on-list
                        color="secondary"
                        :only-countries="['KE', 'UG', 'TZ','US']"
                        @update="results = $event"
                        :success="results?.isValid"
                    />


                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>



            <div class="flex items-center justify-between mt-4">
                <Link :href="route('login')"
                    class="text-sm text-green-600 hover:text-green-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Multiselect from '@vueform/multiselect'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import MazPhoneNumberInput from 'maz-ui/components/MazPhoneNumberInput'
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    department:'',
    site: '',
    gender: '',
    marital_status: '',
    password: '',
    password_confirmation: '',
    date: '',
    phone_number:'',
});

const results = ref();

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
