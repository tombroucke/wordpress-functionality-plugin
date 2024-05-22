<?php 
    if (!defined('ABSPATH')) {
        exit;
    }
?>

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Naam <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" placeholder="Naam" aria-label="Naam" required="">
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">E-mailadres <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control" placeholder="E-mailadres" aria-label="E-mailadres" required="">
    </div>
    <div class="col-12">
        <label for="message" class="form-label">Bericht <span class="text-danger">*</span></label>
        <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Bericht" aria-label="Bericht"
            required=""></textarea>
    </div>
	 <div class="col-md-12">
      	<div class="form-check">
            <input class="form-check-input" type="checkbox" name="privacy" id="privacy" required>
            <label class="form-check-label" for="privacy">
                Ik ga ermee akkoord dat deze informatie opgeslagen en gebruikt wordt om mij te contacteren.
            </label>
       </div>
  	</div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">
            Verzenden
        </button>
    </div>
</div>
