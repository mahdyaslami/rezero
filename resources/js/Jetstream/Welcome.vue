<script setup>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import IconTote from '@/Components/IconTote.vue'
import IconPassword from '@/Components/IconPassword.vue'
import IconArrowLeft from '@/Components/IconArrowLeft.vue'
</script>

<template>
  <div>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      <div>
        <JetApplicationLogo class="block h-12 w-auto" />
      </div>

      <div class="mt-8 text-2xl">
        به مجموعه برنامه های Rezero خوش آمدید.
      </div>

      <div class="mt-6 text-gray-500">
        مجموعه برنامه های Rezero قرار است به تعداد ۱۰۰ عدد گسترش پیدا کند
        این برنامه ها شامل برنامه های کاربردی، برنامه های توسعه فردی، مدیریت
        تیم و ... خواهد بود.
      </div>
    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
      <div class="p-6">
        <div class="flex items-center">
          <IconTote class="w-8 h-8" fill="gray" />
          <div class="ltr:ml-4 rtl:mr-4 text-lg text-gray-600 leading-7 font-semibold">
            <a href="https://laravel.com/docs">Tote</a>
          </div>
        </div>

        <div class="ltr:ml-12 rtl:mr-12">
          <div class="mt-2 text-sm text-gray-500">
            یک برنامه Todo ساده به همراه گروه بندی. این برنامه قابلیت
            نصب به عنوان PWA را دارد. داده های این برنامه در Local Storage
            ذخیره می شوند و می تواند به صورت Offline هم به کار خود
            ادامه دهد.
          </div>

          <a href="https://laravel.com/docs">
            <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
              <div>کاوش در برنامه</div>

              <div class="ltr:ml-1 rtl:mr-1 text-indigo-500">
                <IconArrowLeft class="w-5 h-5" fill="blue" />
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
          <IconPassword class="w-8 h-8" fill="gray" />
          <div class="ltr:ml-4 rtl:mr-4 text-lg text-gray-600 leading-7 font-semibold">
            <a href="https://laracasts.com">Passwords</a>
          </div>
        </div>

        <div class="ltr:ml-12 rtl:mr-12">
          <div class="mt-2 text-sm text-gray-500">
            برنامه ای برای ذخیره نام کاربری و رمزعبور شما در سرویس های مختلف
            و قابل دسترس از هر نثطه.
          </div>

          <a href="https://laracasts.com">
            <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
              <div>کاوش در برنامه</div>

              <div class="ltr:ml-1 rtl:mr-1 text-indigo-500">
                <IconArrowLeft class="w-5 h-5" fill="blue" />
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
