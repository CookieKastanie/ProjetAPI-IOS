//
//  Prof.swift
//  AppliCours
//
//  Created by andre jeremy on 30/01/2019.
//  Copyright © 2019 ramousset vincent. All rights reserved.
//

import Foundation

struct Prof: Codable {
    var mailProf: String
    var nom: String
    var prenom: String
    var presentation: String
    
    enum CodingKeys: String, CodingKey {
        case mailProf
        case nom
        case prenom
        case presentation
    }
    
    init(from decoder: Decoder) throws {
        let valueContainer = try decoder.container(keyedBy: CodingKeys.self)
        
        self.mailProf = try valueContainer.decode(String.self, forKey: CodingKeys.mailProf)
        self.nom = try valueContainer.decode(String.self, forKey: CodingKeys.nom)
        self.prenom = try valueContainer.decode(String.self, forKey: CodingKeys.prenom)
        self.presentation = try valueContainer.decode(String.self, forKey: CodingKeys.presentation)
    }
}
