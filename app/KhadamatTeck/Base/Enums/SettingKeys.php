<?php

namespace App\KhadamatTeck\Base\Enums;

class SettingKeys
{

    // Resident App Settings - using [companyId]
    const ResidentSettingPrimaryColor = "resident_setting_primary_key";
    const ResidentSettingSecondaryColor = "resident_setting_secondary_key";
    const ResidentSettingLogo = "resident_setting_logo";

    // My SP Settings - using [companyId]
    const InHouseAutoAssignTechnician = "inhouse_auto_assign_technician_to_order";
    const InHouseAutoAssignContractor = "inhouse_auto_assign_contractor_to_order";
    const InHouseAutoAssignVendor = "inhouse_auto_assign_vendor_to_order";

}
