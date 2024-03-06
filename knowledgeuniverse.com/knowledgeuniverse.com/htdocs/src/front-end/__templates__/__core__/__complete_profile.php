<div class="signup-container mb-3" id="home_profile_alert">
  <div class="row">

    <div class="col-10">

      <p class="text-start text-white ms-2 mt-1 h6 p-2 head-text small font-weight-normal">
        <span class="text-danger">Warning:</span> Complete your
        
        <? if(!UserData::is_personal_details_completed()){
          ?><a href="/personal_details">Profile</a><?
        } elseif(!UserData::is_contact_details_completed()){
          ?><a href="/contact_details">Profile</a><?
        } elseif(!UserData::is_education_details_completed()){
          ?><a href="/education_details">Profile</a><?
        } elseif(!UserData::is_career_details_completed()){
          ?><a href="/career_details">Profile</a><?
        } elseif(!UserData::is_address_details_completed()){
          ?><a href="/address_details">Profile</a><?
        } elseif(!UserData::is_id_proof_completed()){
          ?><a href="/id_verification">Profile</a><?
        }else{
          ?><a href="/skill">Profile</a><?
        } ?>
        
        , otherwise you can't access all features of knowledegeuniverse services.
      </p>

    </div>

    <div class="col-2 text-end text-white">
      <button class="btn btn-sm mt-1 me-2 text-danger" id="home_profile_cancel">X</button>
    </div>

  </div>
</div>

