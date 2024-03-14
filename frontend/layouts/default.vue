<template>
  <nav>
    <a href="/" class="active">Home</a>
    <a href="/about">About</a>
    <a href="/contact">Contact</a>
    <a href="/login">Login</a>
  </nav>
  <NuxtPage />
</template>

<script>
</script>

<style>
  nav {
    background-color: #4CAF50;
    overflow: hidden;
  }
  nav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }
  nav a:hover {
    background-color: #ddd;
    color: black;
  }
  nav a.active {
    background-color: #4CAF50;
    color: white;
  }
</style>