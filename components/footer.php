</main>
    <footer>
        <p id="footerText"></p>
    </footer>
      </div>

        <!-- Script JavasCript pour le changement de date automatique chaque année -->
   <script>
   const date = new Date().getFullYear();
        const footerText = `&copy; ${date} Mon Premier Modèle de Page Dynamique`;
        document.getElementById('footerText').innerHTML = footerText;
</script>

   </body>
 </html>