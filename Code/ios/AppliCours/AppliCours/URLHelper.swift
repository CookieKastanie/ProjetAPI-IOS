//
//  URLHelper.swift
//  AppliCours
//
//  Created by andre jeremy on 30/01/2019.
//  Copyright © 2019 ramousset vincent. All rights reserved.
//

import Foundation

extension URL {
    func withQueries(_ queries: [String: String]) -> URL? {
        
        var components = URLComponents(url: self, resolvingAgainstBaseURL: true)
        components?.queryItems = queries.map { URLQueryItem(name: $0.0, value: $0.1)}
        return components?.url
    }
}
