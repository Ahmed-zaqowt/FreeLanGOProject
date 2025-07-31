مرحبا فريلانسر اهليين !!

<form method="POST" action="{{ route($guard . '.logout') }}">
      @csrf
      <button type="submit">تسجيل الخروج</button>
</form>
