<template>
    <Head title="Commutes" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Commute
                </h2>
            </div>
        </template>

        <div class="w-5/6 mx-auto my-16 border border-gray-500 rounded-lg">
            <div
                class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-xl">لیست ورود و خروج</p>
                <div>
                    <Link
                        :href="route('commute.create')"
                        as="button"
                        type="button"
                        class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#FFFF00] hover:bg-[#FFFF00] text-black border border-transparent hover:border-black"
                    >
                        ثبت ورود و خروج جدید
                    </Link>
                </div>
            </div>
            <ul>
                <li
                    v-for="(commute, index) in commutes"
                    :key="index"
                    class="flex flex-row justify-between w-full min-h-min py-4 px-4 border-b-2 border-neutral-100 items-center hover:bg-[#21252908]"
                >
                    <div class="content flex flex-row w-[20%] justify-between">
                        {{ commute.employee_name }}
                    </div>
                    <div class="content flex flex-row w-[20%] justify-between">
                        <div>
                            <!-- <b> روز : </b> -->
                            {{ commute.day }}
                        </div>
                    </div>
                    <div class="content flex flex-row w-[20%] justify-between">
                        <div>
                            ورود :
                            {{ commute.enter }}
                        </div>
                    </div>
                    <div class="content flex flex-row w-[20%] justify-between">
                        <div>
                            خروج :
                            {{ commute.exit }}
                        </div>
                    </div>
                    <div class="content flex flex-row w-[20%] justify-between">
                        <div>
                            حقوق :
                            {{ commute.salary }}
                        </div>
                    </div>

                    <div class="min-w-max px-5 flex flex-row justify-between">
                        <button
                            @click="remove(commute.id)"
                            class="h-8 px-4 m-2 flex items-center text-sm text-white duration-150 rounded-lg bg-red-600 border-red-600 border hover:border-black"
                            as="button"
                            type="button"
                        >
                            حذف
                            <TrashIcon class="size-5"></TrashIcon>
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        <p
            class="flex flex-row justify-center text-xl text-center"
            v-if="$page.props.crud.success"
        >
            {{ $page.props.crud.success }}
        </p>
    </AuthenticatedLayout>
</template>

<script>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import {
    TrashIcon,
    EyeIcon,
    PencilSquareIcon,
    PlusCircleIcon,
} from "@heroicons/vue/24/solid";

export default {
    components: {
        Link,
        usePage,
        router,
        useForm,
        AuthenticatedLayout,
        Head,
        Dashboard,
        TrashIcon,
        EyeIcon,
        PlusCircleIcon,
        PencilSquareIcon,
    },
    props: {
        commutes: Object,
        errors: Object,
    },
    setup(props) {
        function remove(id) {
            if (confirm("آیا از حذف ورود و خروج مطمئنید ؟")) {
                router.delete(route("commute.delete", id));
            }
        }

        return { remove };
    },
};
</script>

<style></style>
